import MySQLdb
import random
import time

disaster_list = {
                    'famine': 'food', 
                    'outage': 'power', 
                    'drought': 'water', 
                    'winter': 'gas', 
                    'depression': 'luxury'
                }

disaster_count = {
                    'famine': 0, 
                    'outage': 0, 
                    'drought': 0, 
                    'winter': 0, 
                    'depression': 0
                 }

resources = ['water', 'food', 'gas', 'electricity', 'luxury']

def connect_db():
    """
        Connects to our MySQL database

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

    for r in resources:
        cur.execute("SELECT has_%s FROM starting_resources WHERE cid='%s'" %
                    (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            if r == resource:
                return True
        
        cur.execute("SELECT has_%s FROM acquired_resources WHERE cid='%s'" %
                    (r, cid))
        code = cur.fetchone()
        if code[0] != "0":
            if r == resource:
                return True

    return False


def pick_disaster():
    """ 
        Picks a random disaster ( the dict is weighted so not one disaster
        happens too many times)

        :return current_disaster: the disaster that was randomly picked
    """
    num = random.randint(0, 4)
    disasters = disaster_list.keys()
    current_disaster = disasters[num]
    disaster_count[current_disaster] += 1
    return current_disaster


def hit_team(cid):
    """
        Subtract money from a teams account since they didn't have the resource

        :param cid: the cid of the country to 
    """
    cur = db.cursor()
    cur.execute("SELECT balance FROM users WHERE cid='%s'" % (cid))
    balance = cur.fetchone()
    balance = float(balance[0])
    balance = balance - 10
    cur.execute("UPDATE users SET balance='%s' WHERE cid='%s'" %
                (balance, cid))
    db.commit()
    print "%s new balance: %s" % (str(cid), str(balance))


def poll_teams(disaster):
    """
        Polls teams to see if they have the resource for the disaster

        :param disaster: the current disaster hitting
    """
    resource = disaster_list[disaster]
    for cid in range(1, 11):
        check = poll(cid, resource)
        print "Polling %d, %s | Result - %r" % (cid, resource, check)
        if not check:
            hit_team(cid)

if __name__ == '__main__':
    while True:
        f = open('disaster.txt', 'w+')
        current_disaster = pick_disaster()
        print current_disaster
        f.write(str(current_disaster))
        poll_teams(current_disaster)
        f.close()
        time.sleep(10)

