# Generates a random code to represent a resource
import argparse
import random
import string
import MySQLdb

# creates a unique code
def create_code():
    return ''.join(random.SystemRandom().choice(string.ascii_uppercase + string.digits) for _ in range(30))


# update the code in the database for the given resource
def update_code(code, resource):
    db = MySQLdb.connect(host='localhost',
                         user='ists',
                         passwd='ists15sparsa',
                         db='sparsa')
    cur = db.cursor()
    
    # inserts our code into the database, if theres already a code for the type it will update it
    cur.execute("""INSERT INTO resources(code, type) VALUES(%s, %s) ON DUPLICATE KEY UPDATE
                    code=VALUES(code), type=VALUES(type)""", (code, resource))
    db.commit()


if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Create a code for a given resource')
    parser.add_argument('-t', help='The type of resource to create a code for', dest='resource', required=True)
    args = parser.parse_args()
    code = create_code();
    update_code(code, args.resource)
