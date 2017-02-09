# Generates a random code to represent a resource
import argparse
import random
import string
import MySQLdb


def create_code():
    """
        Generates a random string of numbers and characters to represent a resource

        :returns: a 30 character long string of alpha numeric characters
    """
    return ''.join(random.SystemRandom().choice(string.ascii_uppercase + string.digits) for _ in range(30))


def update_code(database, code, resource, cid):
    """
        Inserts a new code into the specified database and table for a certain user

        :param database: the database to insert into, either starting_resources or acquired_resources
        :param code: the code value of the resource to be entered in
        :param resource: the type of resource being enter in, water, gas, etc.
        :param cid: the country id this code is being entered into
    """
    db = MySQLdb.connect(host='localhost',
                         user='root',
                         passwd='con162ess',
                         db='ists')
    cur = db.cursor()
    
    cur.execute("INSERT INTO %s (has_%s) VALUES (%s) WHERE cid=%s"
                % (database, resource, code, cid))
    db.commit()


if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='Create a code for a given resource')
    parser.add_argument('-t', help='The type of resource to create a code for', dest='resource', required=True)
    parser.add_argument('-d', help='The database to be entered into', dest='database', required=True)
    parser.add_argument('-c', help='The cid of the country the resource is for', dest='cid', required=True)

    args = parser.parse_args()
    code = create_code();
    update_code(args.database, code, args.resource, args.cid)
