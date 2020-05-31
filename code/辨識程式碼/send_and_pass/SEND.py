import time
from subprocess import call
# from scipy.signal import lfilter
# from A_weighting import A_weighting
import httplib,urllib,urllib2
import ConfigParser
import unittest

config = ConfigParser.ConfigParser()
configpath = r'/Users/Eric/Desktop/Python Project/TH-SEND-WEB/config.ini'
config.read(configpath)
config.read(configpath)

ini_ma_no = config.get('Rpi', 'Machine_ID')
ini_dalay_sec = float(config.get('Rpi', 'Time_Interval'))
ini_tty_timeout = float(config.get('Rpi', 'tty_Timeout'))
ini_pwd = config.get('Server', 'Password')
ini_url = config.get('Server', 'URL')
ini_timeout = float(config.get('Server', 'Timeout'))


def post_server(mg):
    data = {'ma_no': ini_ma_no, 'mg': mg, 'password': ini_pwd}
    ress = urllib2.urlopen(
        url=ini_url,
        data=urllib.urlencode(data),
        timeout=ini_timeout
    )
    print(mg)
while True:
    if __name__ == "__main__":
        try:
            post_server(30)
            break
        except IOError, e:
            print e
            print "Error creating connection to i2c.  This must be run as root"