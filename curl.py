#!/home/al/.amkamdam/bin/python3.10
# import pycurl
import certifi
from io import BytesIO
from fake_useragent import UserAgent
from stem.control import Controller
from stem import Signal
from datetime import datetime
import time


def get_current_ip():
    with Controller.from_port(port=9051) as controller:
        controller.authenticate(password="")
        controller.signal(Signal.NEWNYM)

    ua = UserAgent()
    userAgent = ua.random
    buffer = BytesIO()
    c = pycurl.Curl()
    c.setopt(pycurl.PROXY, "127.0.0.1")
    c.setopt(pycurl.PROXYPORT, 9050)
    c.setopt(pycurl.PROXYTYPE, pycurl.PROXYTYPE_SOCKS5)
    # c.setopt(c.URL, 'http://da.com/')
    # c.setopt(c.URL, '82.165.5.243')
    c.setopt(c.URL, 'https://www.amkamdam.com/?kggggggggggggggggggg')
    # c.setopt(c.URL, 'https://www.amkamdam.com/nft-news/')
    # c.setopt(c.URL, 'https://www.amkamdam.com/test/click-iframe/a.html')
    c.setopt(c.WRITEDATA, buffer)
    c.setopt(c.CAINFO, certifi.where())
    c.setopt(pycurl.USERAGENT, userAgent)
    # print(c.getinfo(pycurl.IPRESOLVE))
    # print(c.getinfo(pycurl.PRIMARY_IP))
    c.perform()
    c.close()

    body = buffer.getvalue()
    # Body is a byte string.
    # We have to know the encoding in order to print it to a text file
    # such as standard output.
    # print(body.decode('iso-8859-1'))
    kak = body.decode('iso-8859-1')
    ku = None


if __name__ == "__main__":
    for i in range(1):
    # while True:
        get_current_ip()
        # renew_tor_ip()
        # time.sleep(5)
        print(datetime.today().strftime('%Y-%m-%d %H:%M:%S'))
