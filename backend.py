import flask
import hashlib
import MySQLdb
from flask import Flask
app = Flask(__name__)

def connect_db():
    """
        Create our connection to the mysql database

        :return db: the object for our database connection
    """
    db = MySQLdb.connect(host='localhost', user='root', 
                         passwd='con162ess', db='ists')
    return db


def authenticate(session):
    """
        Authenticates a country from the given session

        :param session: the session variable submitted in the request
        :returns status: status of the authentication, the cid if valid, 0 if invalid
    """
    cur = db.cursor()
    cur.execute("SELECT cid FROM sessions WHERE sessionid=%s" % (session))
    cid = cur.fetchone()
    if not cid:
        return 0
    else:
        return cid


def check_ally(country1, country2):
    """
        Checks if two countries are allies when a new code for a resource
        is added, to determine if the resource is shared or stolen.

        :param country1: one of the country whose adding a resource, accept country or cid
        :param country2: the country the resource belongs to, accepts country or cid
        :return status: If the countries are allies or not, 1 if yes, 0 if no
    """
    cur  = db.cursor()

    if isinstance(country1, int):
        cid1 = country1
    else:
        cur.execute("SELECT cid FROM users WHERE user = %s" % (country1))
        cid1 = cur.fetchone()
    
    if isinstance(country2, int):
        cid2 = country2
    else:
        cur.execute("SELECT cid FROM users WHERE user = %s" % (country2))
        cid2 = cur.fetchone()

    cur.execute("SELECT atpeace%s FROM relations WHERE cid=%s" % (cid1, cid2))
    check1 = cur.fetchone()
    cur.execute("SELECT atpeace%s FROM relations WHERE cid=%s" % (cid2, cid1))
    check2 = cur.fetchone()

    if int(check1) == 1 and int(check2) == 1:
        return 1
    else:
        return 0


def check_resource(resource):
    """
        Checks which country the resource belongs to

        :param resource: the code for that specific resource
        :return country: the country the resource belongs to
        :return type: the type of resource the code is for
    """
    cur = db.cursor()
    
    # check if it's a code for water
    cur.execute("SELECT cid FROM starting_resources WHERE has_water=%s" % (resource))
    cid = cur.fetchone()
    if cid:
        return (cid, "water")

    # check if it's a code for gas
    cur.execute("SELECT cid FROM starting_resources WHERE has_gas=%s" % (resource))
    cid = cur.fetchone()
    if cid:
        return (cid, "gas")

    # check if it's a code for electricity
    cur.execute("SELECT cid FROM starting_resources WHERE has_electricity=%s" % (resource))
    cid = cur.fetchone()
    if cid:
        return (cid, "electricity")

    # check if it's a code for food
    cur.execute("SELECT cid FROM starting_resources WHERE has_food=%s" % (resource))
    cid = cur.fetchone()
    if cid:
        return (cid, "food")

    # check if it's a code for luxury
    cur.execute("SELECT cid FROM starting_resources WHERE has_luxury=%s" % (resource))
    cid = cur.fetchone()
    if cid:
        return (cid, "luxury")

    return (None, None)


@app.route('/addally', methods=['POST'])
def add_ally():
    """
        Handles request for adding an ally

        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return 401 # bad auth

    country_to_add = args['country']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE user = %s" % (country))
    cid2 = cur.fetchone()
    
    cur.execute("INSERT INTO relations (atpeace%s) VALUES (1) WHERE cid=%s" % (cid2, cid))
    
    # unsure if i want to automatically make both teams allies if only one of them adds the other
    # maybe make it so they both have to add each other
    #cur.execute("INSERT INTO relations (atpeace%s) VALUES (1) WHERE cid=%s" % (cid, cid2))
    db.commit()

    return 200


@app.route('/removeally', methods=['POST'])
def remove_ally():
    """
        Handles request for removing an ally
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return 401 # bad auth

    country_to_remove = args['country2']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE user = %s" % (country_to_remove))
    cid2 = cur.fetchone()
    
    cur.execute("INSERT INTO relations (atpeace%s) VALUES (0) WHERE cid=%s" % (cid2, cid))
    
    #cur.execute("INSERT INTO relations (atpeace%s) VALUES (0) WHERE cid=%s" % (cid, cid2))
    db.commit()

    # add the removal of the resources that they two teams share as well
    return 200


@app.route('/declarewar', methods=['POST'])
def declare_war():
    """
        Handles request for declaring war on a team
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return 401 # bad auth

    country_to_attack = args['country2']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE user = %s" % (country_to_attack))
    cid2 = cur.fetchone()
    
    cur.execute("INSERT INTO relations (atwar%s) VALUES (1) WHERE cid=%s" % (cid2, cid))
    cur.execute("INSERT INTO relations (atwar%s) VALUES (1) WHERE cid=%s" % (cid, cid2))
    db.commit()

    return 200


@app.route('/addresource', methods['POST'])
def add_resource():
    """
        Handles adding a new resource to a country

        :return status: status of the request, 200 for OK, 500+ for error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return 401 # bad auth

    country = args['country']
    resource = args['resource']
    resource_owner, resource_type = check_resource(resource)
    if not resource_owner or not resource_type:
        return 503 # bad resource code
    
    status = check_ally(country, resource_owner)
    if status:
        # add resource to database here
    else:
        # add resource to database of the one who entered it, remove it from the one who owns it

    return 200


if __name__ == '__main__':
    db = connect_db()
    app.run()
