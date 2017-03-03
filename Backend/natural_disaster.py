import random
import resource_poller
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


if __name__ == '__main__':
    while True:
        f = open('disaster.txt', 'w+')
        current_disaster = pick_disaster()
        print current_disaster
        f.write(str(current_disaster))
        resource = disaster_list[current_disaster]
        #for cid in range(1, 11):
            #resource_poller.poll(cid, resource)
            #print "Polling %d, %s" % (cid, resource)
        f.close()
        time.sleep(10)
