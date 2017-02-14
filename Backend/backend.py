"""
    Backend for our ISTS website
    2/9/2017
    @author: Doshmajhan
"""

import code_generator
import flask
import hashlib
import MySQLdb
import time
from flask import Flask
from flask import jsonify
app = Flask(__name__)

resources = ['water', 'gas', 'food', 'electricity', 'water']

def connect_db():
    """
        Create our connection to the mysql database

        :return db: the object for our database connection
    """
    db = MySQLdb.connect(host='localhost', user='root', 
                         passwd='con162ess', db='ists')
    return db


def bad_auth():
    """
        Handles returning a not authenticated response

        :return response: the object containing our response text and status
    """
    resp = flask.Response('Authentication Failed', status=401, mimetype='text/html')
    return resp


def authenticate(session):
    """
        Authenticates a country from the given session

        :param session: the session variable submitted in the request
        :returns status: status of the authentication, the cid if valid, None if invalid
    """
    cur = db.cursor()
    cur.execute("SELECT cid FROM sessions WHERE sessionid='%s'" % (session))
    cid = cur.fetchone()
    if not cid:
        return None
    else:
        return int(cid[0])


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
        cur.execute("SELECT cid FROM users WHERE countryname='%s'" % (country1))
        cid1 = cur.fetchone()
        cid1 = int(cid1[0])
    
    if isinstance(country2, int):
        cid2 = country2
    else:
        cur.execute("SELECT cid FROM users WHERE countryname='%s'" % (country2))
        cid2 = cur.fetchone()
        cid2 = int(cid2[0])

    cur.execute("SELECT atpeace%s FROM relations WHERE cid='%s'" % (cid1, cid2))
    check1 = cur.fetchone()
    cur.execute("SELECT atpeace%s FROM relations WHERE cid='%s'" % (cid2, cid1))
    check2 = cur.fetchone()

    if int(check1[0]) == 1 and int(check2[0]) == 1:
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

    for r in resources:
        cur.execute("SELECT cid FROM starting_resources WHERE has_%s='%s'" % (r, resource))
        cid = cur.fetchone()
        if cid:
            return (int(cid[0]), r)
    
    return (None, None)


def randomize_resource(resource, cid, old_code)
    """
        Re randomizes the resource of a given country after they have removed an ally
        so that there ally can't just take their code right after and re-enter it, also
        updates the code for the allies they share it with

        :param resource: the resource being randomized
        :param cid: the cid of the country
        :param old_code: the old code value
    """
    cur = db.cursor()
    new_code = code_generator.create_code()
    code_generator.update_code('starting_resources', new_code, resource, cid)
    cur.execute("SELECT cid FROM acquired_resources WHERE has_%s='%s'" % 
                (resource, old_code))
    ally_list = cur.fetchall()
    if ally_list:
        for ally in ally_list:
            cur.execute("UPDATE acquired_resources SET has_%s='%s' WHERE cid='%s'" %
                        (resource, new_code, ally[0]))



@app.route('/login', methods=['GET', 'POST'])
def login():
    """
        Function to handle logging in of a certain country

        :param country: the country logging in
        :param password: the password for the country
        :return session: the newly created session token for that country
    """
    args = flask.request.args
    country = args['country']
    password = args['password']
    cur = db.cursor()
    cur.execute("SELECT cid FROM users WHERE countryname='%s' AND password='%s'" 
                % (country, password))

    cid = cur.fetchone()
    if not cid:
        return bad_auth()
    cid = int(cid[0])

    m = hashlib.md5()
    m.update(country+password)
    session = m.hexdigest()
    t = time.time()
    ip = flask.request.remote_addr
    cur.execute("UPDATE sessions SET sessionid='%s', time='%s', ip='%s' WHERE cid=%s"
                % (session, t, ip, cid))
    db.commit()
    return session


@app.route('/getresources', methods=['GET'])
def get_resources():
    """
        Returns the resources currently owned by that country

        :param country: the country that owns the resources
        :returns resource: a json object of the resources
    """
    args = flask.request.args
    country = args['country']
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()

    cur = db.cursor()
    starting_resources = []
    acquired_resources = []
    json_data = {}

    for r in resources:
        cur.execute('SELECT has_%s FROM starting_resources WHERE cid=%s'
                    % (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            starting_resources += [(r, code[0])]
            continue

        cur.execute('SELECT has_%s FROM acquired_resources WHERE cid=%s'
                    % (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            acquired_resources += [(r, code[0])]

    json_data['starting_resources'] = starting_resources
    json_data['acquired_resources'] = acquired_resources
    return jsonify(json_data)


@app.route('/getallies', methods=['GET'])
def get_allies():
    """
        Returns the allies for the requesting country

        :param session: the session token for the requesting country
        :return allies_json: a json object of the allies 
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()
    
    allies_json = {}
    allies_json['allies'] = []
    cur = db.cursor()
    
    for x in range(1, 12):
        cur.execute("SELECT at_peace%s FROM relations WHERE cid='%s'" % (x, cid))
        relation = cur.fetchone()
        relation = int(relation[0])
        if relation:
            cur.execute("SELECT countryname FROM users WHERE cid='%s'" % (cid))
            country = cur.fetchone()[0]
            allies_json['allies'] += [country]

    return jsonify(allies_json)


@app.route('/getenemies', methods=['GET'])
def get_enemies():
    """
        Returns the enemies for the requesting country

        :param session: the session token for the requesting country
        :return enemies_json: a json object of the allies 
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()
    
    enemies_json = {}
    enemies_json['enemies'] = []
    cur = db.cursor()
    
    for x in range(1, 12):
        cur.execute("SELECT at_war%s FROM relations WHERE cid='%s'" % (x, cid))
        relation = cur.fetchone()
        relation = int(relation[0])
        if relation:
            cur.execute("SELECT countryname FROM users WHERE cid='%s'" % (cid))
            country = cur.fetchone()[0]
            enemies_json['enemies'] += [country]

    return jsonify(enemies_json)


@app.route('/addally', methods=['GET', 'POST'])
def add_ally():
    """
        Handles request for adding an ally
    
        :param session: the session of the country adding an ally
        :param country: the name of the country being added
        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()

    country_to_add = args['country']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE countryname='%s'" % (country_to_add))
    cid2 = cur.fetchone()
    cid2 = int(cid2[0]) 
    cur.execute("UPDATE relations SET atpeace%s='1' WHERE cid='%s'" % (cid2, cid))
    
    db.commit()

    return flask.Response('Ally added', status=200, mimetype='text/html')


@app.route('/removeally', methods=['GET', 'POST'])
def remove_ally():
    """
        Handles request for removing an ally
    
        :param session: the session of the country removing an ally
        :param country: the name of the country being removed
        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()

    country_to_remove = args['country']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE countryname='%s'" % (country_to_remove))
    cid2 = cur.fetchone()
    cid2 = int(cid2[0])

    cur.execute("UPDATE relations SET atpeace%s='0' WHERE cid='%s'" % (cid2, cid))
    cur.execute("UPDATE relations SET atpeace%s='0' WHERE cid='%s'" % (cid, cid2))

    # also re randomize the code so the team can't just re enter it and steal it
    # also need to make sure we check if the code even exists before randomizing and re entering
    # could have been stolen during that time
    
    for r in resources:
        # Check if remover is using a resource of the removee, if so remove it
        cur.execute("SELECT has_%s FROM acquired_resources WHERE cid='%s'" % (r, cid))
        acquired_resource = cur.fetchone()
        acquired_resource = acquired_resource[0]
        cur.execute("SELECT has_%s FROM starting_resources WHERE cid='%s'" % (r, cid2))
        original_resource = cur.fetchone()
        original_resource = original_resource[0]
        if (acquired_resource == original_resource) and \
            (acquired_resource != "0" or original_resource != "0") :
            
            print "Removing %s from %d" % (r, cid)
            cur.execute("UPDATE acquired_resources SET has_%s='0' WHERE cid='%s'"
                        % (r, cid))

            #randomize_code(r, cid2, original_resource)

        # check if the removee is using a resource of the remover
        cur.execute("SELECT has_%s FROM starting_resources WHERE cid='%s'" % (r, cid))
        original_resource = cur.fetchone()
        original_resource = original_resource[0]
        cur.execute("SELECT has_%s FROM acquired_resources WHERE cid='%s'" % (r, cid2))
        acquired_resource = cur.fetchone()
        acquired_resource = acquired_resource[0]
        if (acquired_resource == original_resource) and \
            (acquired_resource != "0" or original_resource != "0"):
            
            print "Removing %s from %d" % (r, cid2)
            cur.execute("UPDATE acquired_resources SET has_%s='0' WHERE cid='%s'"
                        % (r, cid2))

            #randomize_code(r, cid, original_resource)

    db.commit()

    return flask.Response('Ally removed', status=200, mimetype='text/html')


@app.route('/declarewar', methods=['GET', 'POST'])
def declare_war():
    """
        Handles request for declaring war on a team
        first for

        :param session: the session for the country declaring war
        :param country: the name of the country being declared against
        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()

    country_to_attack = args['country']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE countryname='%s'" % (country_to_attack))
    cid2 = cur.fetchone()
    cid2 = int(cid2[0])

    cur.execute("UPDATE relations SET atwar%s='1' WHERE cid='%s'" % (cid2, cid))
    cur.execute("UPDATE relations SET atwar%s='1' WHERE cid='%s'" % (cid, cid2))
    db.commit()

    return flask.Response('War declared', status=200, mimetype='text/html')


@app.route('/addresource', methods=['GET', 'POST'])
def add_resource():
    """
        Handles adding a new resource to a country

        :param session: the session of the country adding a resource
        :param resource: the code of the resource being added
        :return status: status of the request, 200 for OK, 500+ for error
    """
    args = flask.request.args
    cur = db.cursor()
    session = args['session']
    cid = authenticate(session)
    if not cid:
        return bad_auth()

    resource = args['resource']
    resource_owner, resource_type = check_resource(resource)
    if not resource_owner or not resource_type:
        return flask.Response('Invalid resource code', status=403, mimetype='text/html')

    status = check_ally(cid, resource_owner)
    if status:
        cur.execute("UPDATE acquired_resources SET has_%s='%s' WHERE cid='%s'" 
                    % (resource_type, resource, cid))
    
    else:
        # need to remove the resource from people who are sharing it with that person too
        cur.execute("UPDATE starting_resources SET has_%s='%s' WHERE cid='%s'" 
                    % (resource_type, resource, cid))
        cur.execute("UPDATE starting_resources SET has_%s='0' WHERE cid='%s'"
                    % (resource_type, resource_owner))    
    
    db.commit()       

    return flask.Response('Resource added', status=200, mimetype='text/html')


if __name__ == '__main__':
    db = connect_db()
    app.run(host='0.0.0.0', port=5000)
