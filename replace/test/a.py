#!/home/al/.venv/bin/python3
import glob2
from bs4 import BeautifulSoup
import requests
import time
import shutil
from datetime import datetime

# https://beautiful-soup-4.readthedocs.io/en/latest/

# start_time = time.time()
# todaytime = datetime.today().strftime('%Y-%m-%d %H:%M:%S')
# source = None
#
# try:
#     headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
#     source = requests.get('https://cryptonews.com/news/0x-surges-on-coinbase-pro-listing-more-coins-to-follow-2758.htm', headers=headers, timeout=None)
#
# except Exception as e:
#     print(e)
#     pass
#
# with open('0x-surges-on-coinbase-pro-listing-more-coins-to-follow-2758.htm', "w") as file:
#     file.write(source.text)

# shutil.rmtree('./b/', ignore_errors=True)
# shutil.rmtree('./html/*', ignore_errors=True)
# shutil.copytree('./a/cryptonews.com', './b/', dirs_exist_ok=True)
# shutil.copytree('./replace/', './a/cryptonews.com/', dirs_exist_ok=True)
ka = 0
# for i in range(3):
while True:
    # get_current_ip()
    # renew_tor_ip()
    # time.sleep(3)
    ka = 0
