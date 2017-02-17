import argparse
import MySQLdb
import requests

resources = ['water', 'food', 'gas', 'electricity', 'luxury']


def connect_db():
    """
        Create our connection to the MySQL database

        :return db: the object for our database connection
    """
    
    db = MySQLdb.connect(host='localhost', user='root', 
                         passwd='con162ess', db='ists')
    return db


def poll(cid, resource):
    """
        Checks each teams resources to see if they have the resource
        for the current natural disaster
    
        :param cid: the cid of the country to poll
        :param resource: the resource they need to have
    """
    cur = db.cursor()
    owned_resources = []

    for r in resources:
        cur.execute("SELECT has_%s FROM starting_resources WHERE cid='%s'" %
                    (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            owned_resources += [r]
        
        cur.execute("SELECT has_%s FROM acquired_resources WHERE cid='%s'" %
                    (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            owned_resources += [r]
               
    if resource in owned_resources:
        return True

    return False
    

if __name__ == '__main__':
    db = connect_db()
    result = poll(resource)
    
