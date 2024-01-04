#!/home/al/.venv/bin/python3.10
from selenium.webdriver.chrome.options import Options
from fake_useragent import UserAgent
from xvfbwrapper import Xvfb
from selenium import webdriver
from selenium.webdriver.support import expected_conditions as ec
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from stem.control import Controller
from stem import Signal
import time
from datetime import datetime
from selenium.webdriver.chrome.service import Service
import os, signal


def get_current_ip():
    with Controller.from_port(port=9051) as controller:
        controller.authenticate(password="")
        controller.signal(Signal.NEWNYM)

    display = Xvfb()
    display.start()
    ua = UserAgent()
    userAgent = ua.random
    options = Options()
    options.add_argument('user-agent={}'.format(userAgent))
    PROXY = "socks5://localhost:9050"
    options.add_argument('--proxy-server=%s' % PROXY)
    options.headless = True

    # driver = webdriver.Chrome(options=options, executable_path="/var/www/da-1.com/html/test/click-iframe/chromedriver")
    # driver = webdriver.Chrome(options=options, executable_path="./chromedriver")
    # driver = webdriver.Chrome(options=options, service=Service(ChromeDriverManager().install()))
    service = Service(executable_path='./chromedriver')
    driver = webdriver.Chrome(service=service, options=options)
    print(datetime.today().strftime('%H:%M:%S') + ' tor4')
    with open('zuy1', "a") as file:
        file.write(datetime.today().strftime('%Y-%m-%d %H:%M:%S') + ' tor4\n')
    driver.get("https://amkamdam.com/news/bitcoin-news/")
    # url = "http://da-1.com/test/click-iframe/a.html"
    url = "https://www.amkamdam.com/test/click-iframe/a.html"
    driver.get(url)
    try:
        driver.switch_to.frame('google_ads_iframe')
        WebDriverWait(driver, 10).until(ec.element_to_be_clickable((By.XPATH, '//*[@id="abgl"]'))).click()

    finally:
        driver.quit()
        display.stop()

    # name = 'chrome'
    # try:
    #     for line in os.popen("ps ax | grep " + name + " | grep -v grep"):
    #         fields = line.split()
    #         pid = fields[0]
    #         os.kill(int(pid), signal.SIGKILL)
    #     print("Process Successfully terminated")
    #
    # except:
    #     print("Error Encountered while running script")


# def renew_tor_ip():
#     with Controller.from_port(port=9051) as controller:
#         controller.authenticate(password="")
#         controller.signal(Signal.NEWNYM)


if __name__ == "__main__":
    for i in range(3):
    # while True:
        get_current_ip()
        # renew_tor_ip()
        # time.sleep(3)
