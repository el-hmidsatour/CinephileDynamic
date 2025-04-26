import sys
import os
import json
import argparse # Still needed for other args like --query, --genre etc.
from whoosh.index import open_dir
from whoosh.qparser import MultifieldParser, QueryParser, OrGroup
from whoosh.query import Term, And, Every

# --- Configuration ---
# IMPORTANT: Make sure this path is correct and Apache can READ from it
INDEX_DIR = "C:/xampp/htdocs/CinePhileDynamic/2/controller/index_scripts/whoosh_index" # Example Path
# ------------------

def search_index(query_str, index_dir, filter_genre=None, filter_type=None, limit=50):
    """Searches the Whoosh index and returns results."""
    results_list = []
    try:
        ix = open_dir(index_dir)
    except Exception as e:
        return {'error': f"Could not open index at {index_dir}: {e}", 'results': []}

    searcher = ix.searcher()

    # --- Define the fields to search ---
    # Always include title, genres, description, and actors
    fields_to_search = ['title', 'genres', 'description', 'actors']
    # ----------------------------------

    # Use MultifieldParser with the defined fields
    parser = MultifieldParser(fields_to_search, ix.schema, group=OrGroup)

    # Construct the main query based on the search term
    if query_str:
        try:
            query = parser.parse(query_str)
        except Exception as e:
             return {'error': f"Could not parse query '{query_str}': {e}", 'results': []}
    else:
        # If no search term, match all documents initially
        query = Every("media_id")

    # Construct filter queries (for genre and type)
    filter_list = []
    if filter_genre:
        filter_list.append(Term("genres", filter_genre.lower()))
    if filter_type and filter_type != '%':
        filter_list.append(Term("type", filter_type))

    # Combine the main query and filters
    final_query = query
    if filter_list:
        filter_query = And(filter_list)
        if query_str: # Only combine with AND if there was an actual text query
            final_query = And([query, filter_query])
        else: # If no text query, the filter becomes the main query
            final_query = filter_query

    try:
        # Perform the search
        results = searcher.search(final_query, limit=limit)

        # Extract ID and score for results
        for hit in results:
            results_list.append({
                'id': int(hit['media_id']),
                'score': hit.score,
            })

    except Exception as e:
        searcher.close()
        return {'error': f"Error during search: {e}", 'results': []}
    finally:
        searcher.close()

    return {'error': None, 'results': results_list}


if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='Search the media index.')
    # Keep arguments for query, genre, type, limit
    parser.add_argument('--query', type=str, default='', help='Search term')
    parser.add_argument('--genre', type=str, default=None, help='Filter by genre')
    parser.add_argument('--type', type=str, default=None, help='Filter by type (f or s)')
    parser.add_argument('--limit', type=int, default=100, help='Maximum number of results')
    # REMOVED: Arguments for --search-desc and --search-actors
    # parser.add_argument('--search-desc', action='store_true', ...)
    # parser.add_argument('--search-actors', action='store_true', ...)

    args = parser.parse_args()

    # REMOVED: Logic to conditionally build search_fields list
    # search_fields = ['title', 'genres']
    # if args.search_desc: search_fields.append('description')
    # if args.search_actors: search_fields.append('actors')

    # Perform search - Note: search_fields is no longer passed
    search_results = search_index(
        query_str=args.query,
        index_dir=INDEX_DIR,
        filter_genre=args.genre,
        filter_type=args.type,
        limit=args.limit
    )

    # Output results as JSON
    print(json.dumps(search_results))