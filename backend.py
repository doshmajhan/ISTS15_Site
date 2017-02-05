import flask
import hashlib
import MySQLdb
from flask import Flask
app = Flask(__name__)

def connect_db():
    db = MySQLdb.connect(host='localhost', user='root', 
                         passwd='con162ess', db='ists')
    return db


@app.route('/login', methods=['POST'])
def login():
    """
        Handles logging in for a country
        
        :param country: the country logging in
        :param password: the password of the country
    """
    args = flask.request.args
    username = args['username']
    password = args['password']
    pass_hash = hashlib.sha256(password)
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE user = %s AND password = %s" % (username, pass_hash))
    cid = cur.fetchone()


@app.route('/addally', methods=['POST'])
def add_ally():
    """
        Handles request for adding an ally
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args
    country1 = args['country1']
    country2 = args['country2']
    cur = db.cursor()

    cur.execute("SELECT cid FROM users WHERE user = %s" % (country1))
    cid1 = cur.fetchone()
    cur.execute("SELECT cid FROM users WHERE user = %s" % (country2))
    cid2 = cur.fetchone()
    
    cur.execute("INSERT INTO relations (atpeace%s) VALUES (1) WHERE cid=%s" % (cid2, cid1))
    cur.execute("INSERT INTO relations (atpeace%s) VALUES (1) WHERE cid=%s" % (cid1, cid2))
    db.commit()

@app.route('/removeally', methods=['POST'])
def remove_ally():
    """
        Handles request for removing an ally
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """
    args = flask.request.args


@app.route('/check_ally', methods=['POST'])
def check_ally():
    """
        Checks if two countries are allies when a new code for a resource
        is added, to determine if the resource is shared or stolen.

        :return status: If the countries are allies or not, 1 if yes, 0 if no
    """
    args = flask.request.args


if __name__ == '__main__':
    db = connect_db()
    app.run()
