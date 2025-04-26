import os
# import mysql.connector  # Remove or comment out old connector
import pymysql             # Import PyMySQL
import pymysql.cursors     # Import DictCursor support
from whoosh.index import create_in, open_dir
from whoosh.fields import Schema, ID, TEXT, KEYWORD
from whoosh.analysis import StemmingAnalyzer

# --- Configuration ---
DB_CONFIG = {
    'host': '127.0.0.1',
    'user': 'root',
    'password': '',
    'database': 'cinephile',
    'port': 3306,
    'charset': 'utf8mb4' # Good practice for PyMySQL
}
# Make sure this path is correct for your OS (use / or \\)
INDEX_DIR = "C:/xampp/htdocs/CinePhileDynamic/2/controller/index_scripts/whoosh_index" # IMPORTANT: Change this path
# ------------------

def get_media_data(cnx):
    """Fetches media data with actors and genres from the database using PyMySQL."""
    # Use DictCursor to get results as dictionaries
    cursor = cnx.cursor(pymysql.cursors.DictCursor)
    query = """
    SELECT
        m.Id,
        m.Title,
        m.Description,
        m.Type,
        m.Year,
        m.Country,
        GROUP_CONCAT(DISTINCT ac.FullName SEPARATOR '; ') AS Actors,
        GROUP_CONCAT(DISTINCT g.NameGenre SEPARATOR '; ') AS Genres
    FROM media m
    LEFT JOIN acted act ON m.Id = act.MediaId
    LEFT JOIN actors ac ON act.ActorId = ac.ActorId
    LEFT JOIN tagged tg ON m.Id = tg.MediaId
    LEFT JOIN genres g ON tg.GenreId = g.GenreId
    GROUP BY m.Id
    ORDER BY m.Id;
    """
    cursor.execute(query)
    results = cursor.fetchall()
    cursor.close()
    return results

def create_index_schema():
    """Defines the schema for the Whoosh index. (No changes needed here)"""
    stem_analyzer = StemmingAnalyzer()
    schema = Schema(
        media_id=ID(stored=True, unique=True),
        title=TEXT(stored=True, analyzer=stem_analyzer, field_boost=2.0),
        description=TEXT(analyzer=stem_analyzer),
        actors=TEXT(analyzer=stem_analyzer),
        genres=KEYWORD(stored=True, commas=True, scorable=True, lowercase=True),
        type=ID(stored=True),
        year=ID(stored=True),
        country=ID(stored=True)
    )
    return schema

def build_index(data, index_dir, schema):
    """Builds or updates the Whoosh index. (No changes needed here)"""
    if not os.path.exists(index_dir):
        os.makedirs(index_dir)
        ix = create_in(index_dir, schema)
        print(f"Created new index in {index_dir}")
    else:
        try:
            ix = open_dir(index_dir)
            print(f"Opened existing index in {index_dir}")
        except Exception as e:
             print(f"Error opening index, recreating: {e}")
             ix = create_in(index_dir, schema)


    writer = ix.writer(limitmb=256, procs=os.cpu_count(), multisegment=True)
    indexed_count = 0
    error_count = 0

    print(f"Indexing {len(data)} media items...")
    for item in data:
        try:
            genres_str = item.get('Genres', '')
            if genres_str is None:
                 genres_str = ''
            genres_str = genres_str.replace('; ', ',').lower()

            writer.update_document(
                media_id=str(item['Id']),
                title=item.get('Title', ''),
                description=item.get('Description', ''),
                actors=item.get('Actors', ''),
                genres=genres_str,
                type=item.get('Type', ''),
                year=str(item.get('Year', '')),
                country=item.get('Country', '')
            )
            indexed_count += 1
        except Exception as e:
            print(f"Error indexing item ID {item.get('Id', 'N/A')}: {e}")
            error_count += 1
        if indexed_count % 100 == 0:
             print(f"  Indexed {indexed_count} items...")


    print(f"Committing changes to index ({indexed_count} indexed, {error_count} errors)...")
    writer.commit(optimize=True)
    print("Indexing complete.")

if __name__ == "__main__":
    cnx = None
    try:
        # Connect using PyMySQL keyword arguments
        print(f"Connecting to DB using PyMySQL with config: {DB_CONFIG}")
        cnx = pymysql.connect(**DB_CONFIG)
        print("Database connection successful (PyMySQL).")
        media_items = get_media_data(cnx)
        if media_items:
            schema = create_index_schema()
            build_index(media_items, INDEX_DIR, schema)
        else:
            print("No media data found in the database.")
    # Use PyMySQL specific error type
    except pymysql.Error as err:
        print(f"Database Error (PyMySQL): {err}")
    except Exception as e:
        print(f"An error occurred: {e}")
    finally:
        if cnx: # PyMySQL connection object evaluates to True if connected
            cnx.close()
            print("Database connection closed (PyMySQL).")