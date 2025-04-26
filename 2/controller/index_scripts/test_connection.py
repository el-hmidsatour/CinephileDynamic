import pymysql         # Import the new connector
import sys

config = {
    'host': '127.0.0.1',
    'user': 'root',
    'password': '',
    'database': 'cinephile',
    'port': 3306,
    'charset': 'utf8mb4', # Good practice for PyMySQL
    # 'cursorclass': pymysql.cursors.DictCursor # Optional, can add later
}

try:
    print(f"Attempting to connect with PyMySQL using config: {config}")
    # PyMySQL uses slightly different connection arguments
    cnx = pymysql.connect(
        host=config['host'],
        user=config['user'],
        password=config['password'],
        database=config['database'],
        port=config['port'],
        charset=config['charset']
        # cursorclass=config['cursorclass'] # Optional
    )
    print("PyMySQL Connection Successful!")
    cnx.close()
    print("PyMySQL Connection closed.")
# Make sure to catch PyMySQL specific errors too
except pymysql.Error as err:
    print(f"!!! PyMySQL Connection FAILED: {err}", file=sys.stderr)
except Exception as e:
    print(f"!!! An unexpected error occurred: {e}", file=sys.stderr)