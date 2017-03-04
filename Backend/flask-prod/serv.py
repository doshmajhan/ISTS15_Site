from flask import Flask, render_template,request
import random, math, json
import time
import datetime
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy.exc import IntegrityError # For sql error catching
import hashlib
import sys # for testing
import requests

app = Flask(__name__)
app.config.from_pyfile('settings.cfg')
db = SQLAlchemy(app)
db.create_all()
WHITETEAM = 0
ATM = -1
BILLAMOUNT = 200000
MAXTRANSFER = 50001
TRANSFERTIMEMINS = 20

class Users(db.Model):
    cid = db.Column(db.Integer, primary_key=True)
    countryname = db.Column(db.String(32))
    password = db.Column(db.String(64))
    accountnum = db.Column(db.Integer)
    balance = db.Column(db.Float())
    pin = db.Column(db.Integer)
    lasttransfer = db.Column(db.Integer)

    def __init__(self, cid, accountnum, password, countryname, pin, lasttransfer):
        self.cid = cid
        self.accountnum = accountnum
        self.password = password
        self.countryname = countryname
        self.pin = pin
        self.lasttransfer = lasttransfer

    def __repr__(self):
        return '<User %r>' % (self.cid)

class Session(db.Model):
    __tablename__ = 'session'
    cid = db.Column(db.Integer,primary_key=True)
    session = db.Column(db.String(128))
    time = db.Column(db.Float())
    ip = db.Column(db.String(16))

    def __init__(self, cid=None, session=None, time=None, ip=None):
        self.cid = cid
        self.session = session
        self.time = time
        self.ip = ip

class Audit(db.Model):
    __tablename__ = 'auditing'
    aid = db.Column(db.Integer,primary_key=True)
    cidsrc = db.Column(db.String(255))
    ciddst = db.Column(db.String(255))
    action = db.Column(db.String(255))
    data = db.Column(db.String(255))
    time = db.Column(db.Float())
    ip = db.Column(db.String(16))

    def __init__(self, aid=None, cidsrc=None, ciddst=None, action=None, data=None, time=None, ip=None):
        self.aid = aid
        self.cidsrc = cidsrc
        self.ciddst = ciddst
        self.action = action
        self.data = data
        self.time = time
        self.ip = ip

def addAudit(cidsrc,ciddst,action,data,ip):
    me = Audit(cidsrc=str(cidsrc),ciddst=str(ciddst),action=action,data=data,time=time.time(),ip=ip)
    db.session.add(me)
    try:
        db.session.commit()
    except IntegrityError:
        return None

def writeLogMessage(number,message,data):
        message = {'Error Number':number, 'Error Message':message, 'Error X-Data':data, 'Time':time.time()}
        message_string = json.dumps(message)
        outputLoc = app.config['LOG_OUTPUT']
        outputLoc = outputLoc.split('|')
        if('stdout' in outputLoc):
                print message_string
        if('file' in outputLoc):
                # We could also supoprt a JSON handler here to say ES
                try:
                        myfile = open(app.config['ERROR_LOG'], "a+")
                except IOError:
                        return json.dumps("Error 00: We are unable to process your request")
                try:
                        myfile.write(message_string+"\n")
                except IOError:
                        return json.dumps("Error 00: We are unable to process your request")
                finally:
       				myfile.close()
        return json.dumps("Error " + str(number) + ": We are unable to process your request")


#Takes a accountNum and session
@app.route("/getBalance",methods=['GET','POST'])
def retBalance():
    remote_ip = request.remote_addr
    required = ["countryname","session"]
    # Check if we got our required params
    for param in required:
        if param in request.form.keys():
            continue
        else:
            return writeLogMessage(501,"The required arguments were not provided", str(request.form.keys()))
    accountNum = str(request.form["countryname"])
    result = Users.query.filter(Users.countryname == accountNum).first()
    cid = result.cid
    if(result==None):
        return writeLogMessage(505,"An invalid accountNum was provided",accountNum)
    valid = False
    # Check if we got our required params
    if(len(request.form["session"]) != 0):
        url = 'http://'+app.config['APIADDR']+'/authenticate?session=' + request.form["session"]
        print url
        r = requests.get(url)
        if str(r.text).isdigit() and int(r.text)==int(cid):
            valid = True
        else:
            return writeLogMessage(502,"The session identifier provided expired or was invalid", request.form["session"])
    else:
            return writeLogMessage(503,"The session param provided was empty","")
    if valid == True:
        data = { 'Balance': result.balance }
        encoded_data = json.dumps(data)
        return encoded_data

    else:
        return writeLogMessage(504,"Somehow we got an invalid request, this shouldn't happen", "")

#Takes a accountNum and session
@app.route("/viewPin",methods=['GET','POST'])
def viewPin():
    remote_ip = request.remote_addr
    required = ["countryname","session"]
    # Check if we got our required params
    for param in required:
        if param in request.form.keys():
            continue
        else:
            return writeLogMessage(501,"The required arguments were not provided", str(request.form.keys()))
    accountNum = str(request.form["countryname"])
    result = Users.query.filter(Users.countryname == accountNum).first()
    cid = result.cid
    if(result==None):
        return writeLogMessage(505,"An invalid accountNum was provided",accountNum)
    valid = False
    # Check if we got our required params
    if(len(request.form["session"]) != 0):
        url = 'http://'+app.config['APIADDR']+'/authenticate?session=' + request.form["session"]
        print url
        r = requests.get(url)
        if  str(r.text).isdigit() and int(r.text)==int(cid):
            valid = True
        else:
            return writeLogMessage(502,"The session identifier provided expired or was invalid", request.form["session"])
    else:
            return writeLogMessage(503,"The session param provided was empty","")
    if valid == True:
        data = { 'Pin': result.pin }
        encoded_data = json.dumps(data)
        addAudit(cid,"-1","Viewed PIN",result.pin,remote_ip)
        return encoded_data
    else:
        return writeLogMessage(504,"Somehow we got an invalid request, this shouldn't happen", "")

#Takes a accountNum and session
@app.route("/changePin",methods=['GET','POST'])
def changePin():
    remote_ip = request.remote_addr
    required = ["countryname","session","newPin"]
    # Check if we got our required params
    for param in required:
        if param in request.form.keys():
            continue
        else:
            return writeLogMessage(501,"The required arguments were not provided", str(request.form.keys()))
    accountNum = str(request.form["countryname"])
    result = Users.query.filter(Users.countryname == accountNum).first()
    cid = result.cid
    if(result==None):
        return writeLogMessage(505,"An invalid accountNum was provided",accountNum)
    valid = False
    # Check if we got our required params
    if(len(request.form["session"]) != 0):
        url = 'http://'+app.config['APIADDR']+'/authenticate?session=' + request.form["session"]
        print url
        r = requests.get(url)
        if  str(r.text).isdigit() and int(r.text)==int(cid):
            valid = True
        else:
            return writeLogMessage(502,"The session identifier provided expired or was invalid", request.form["session"])
    else:
            return writeLogMessage(503,"The session param provided was empty","")
    if valid == True:
        newPin = request.form["newPin"]
        if not newPin.isdigit() or len(newPin) != 4:
            return writeLogMessage(506,"The pin was of an invalid format","")
        result.pin = request.form["newPin"]
        try:
            db.session.commit()
        except IntegrityError as e:
            return writeLogMessage(507, "We had an issue updating our pin, with the DB",str(e))
    data = [ { 'Status': "Completed" } ]
    encoded_data = json.dumps(data)
    addAudit(cid,"-1","The pin was changed",request.form["newPin"],remote_ip)
    return encoded_data

@app.route("/transferFunds",methods=['GET','POST'])
def tran():
    remote_ip = request.remote_addr
    required = ["countryname","session","amount","destcountry"]
    # Check if we got our required params
    for param in required:
        if param in request.form.keys():
            continue
        else:
            return writeLogMessage(802,"The required arguments were not provided", str(request.form.keys()))
    accountNum = str(request.form["countryname"])
    result = Users.query.filter(Users.countryname == accountNum).first()
    cid = result.cid
    if(result==None):
        return writeLogMessage(805,"An invalid accountNum was provided",accountNum)
    valid = False
    # Check if we got our required params
    if(len(request.form["session"]) != 0):
        url = 'http://'+app.config['APIADDR']+'/authenticate?session=' + request.form["session"]
        print url
        r = requests.get(url)
        if  str(r.text).isdigit() and  int(r.text)==int(cid):
            valid = True
    if valid == True:
        result = Users.query.filter(Users.countryname == accountNum).first()
        if(time.time()-600 > result.lasttransfer):
            dest = request.form["destcountry"]
            result2 = Users.query.filter(Users.countryname == dest).first()
            amount = request.form["amount"]
            if amount.isdigit() and float(amount) > 60000:
                addAudit(cid,dest,"Transfer Funds too large",amount,remote_ip)
                return json.dumps("You may only transfer a max of $60,000")
            if amount.isdigit() and float(amount) <= 0:
                addAudit(cid,dest,"Transfer Funds too small",amount,remote_ip)
                return json.dumps("You may not transfer negative amounts")
            if not amount.isdigit():
                return writeLogMessage(806,"An invalid accountNum was provided",amount)
            addAudit(cid,request.form["destcountry"],"TESTING"+dest,"",remote_ip)
            result2.balance = result2.balance + float(amount)
            result.balance = result.balance - float(amount)
            result.lasttransfer = time.time()
            try:
                db.session.commit()
            except IntegrityError as e:
                return writeLogMessage(807, "We had an issue updating our pin, with the DB",str(e))
        else:
            addAudit(cid,request.form["destcountry"],"Transfer funds too often",request.form["amount"],remote_ip)
            return json.dumps("You can only transfer once every 10 minutes")
    else:
        return writeLogMessage(809, "invalid session",str(r.text))
    addAudit(cid,request.form["destcountry"],"Transfer Funds",request.form["amount"],remote_ip)
    data = [ { 'Status': "Completed" } ]
    encoded_data = json.dumps(data)
    return str(encoded_data)


#Takes a accountNum and session
@app.route("/changePassword",methods=['GET','POST'])
def changePassword():
    remote_ip = request.remote_addr
    required = ["countryname","session","newPassword"]
    # Check if we got our required params
    for param in required:
        if param in request.form.keys():
            continue
        else:
            return writeLogMessage(501,"The required arguments were not provided", str(request.form.keys()))
    accountNum = str(request.form["countryname"])
    result = Users.query.filter(Users.countryname == accountNum).first()
    cid = result.cid
    if(result==None):
        return writeLogMessage(505,"An invalid countryname was provided",accountNum)
    valid = False
    # Check if we got our required params
    if(len(request.form["session"]) != 0):
        url = 'http://'+app.config['APIADDR']+'/authenticate?session=' + request.form["session"]
        print url
        r = requests.get(url)
        if  str(r.text).isdigit() and int(r.text)==int(cid):
            valid = True
        else:
            return writeLogMessage(502,"The session identifier provided expired or was invalid", request.form["session"])
    else:
            return writeLogMessage(503,"The session param provided was empty","")
    if valid == True:
        newPass = request.form["newPassword"]
        if len(newPass) > 63:
            return writeLogMessage(506,"The password was of an invalid format","")
        result.password = request.form["newPassword"]
        try:
            db.session.commit()
        except IntegrityError as e:
            return writeLogMessage(507, "We had an issue updating our password with the DB",str(e))
    addAudit(cid,"-1","Changed password","",remote_ip)
    data = [ { 'Status': "Completed" } ]
    encoded_data = json.dumps(data)
    return encoded_data
if __name__ == "__main__":
	print app.config['LISTENADDR']
	app.run(host=app.config['LISTENADDR'],port=1337,debug=False)

