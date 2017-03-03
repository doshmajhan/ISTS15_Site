# Generates a random code to represent a resource
import random
import string

if __name__ == '__main__':
    """for x in range(10):
        print ''.join(random.SystemRandom().choice(string.digits) for _ in range(10))"""
    for x in range(10):
        print ''.join(random.SystemRandom().choice(string.digits) for _ in range(4))

