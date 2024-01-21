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


def get_current_ip():
    with Controller.from_port(port=9051) as controller:
        controller.authenticate(password="")
        controller.signal(Signal.NEWNYM)

    # display = Xvfb()
    # display.start()
    ua = UserAgent()
    userAgent = ua.random
    options = Options()
    options.add_argument('user-agent={}'.format(userAgent))
    PROXY = "socks5://localhost:9050"
    options.add_argument('--proxy-server=%s' % PROXY)
    # options.headless = True

    # driver = webdriver.Chrome(options=options, executable_path="/var/www/da-1.com/html/test/click-iframe/chromedriver")
    # driver = webdriver.Chrome(options=options, executable_path="./chromedriver")
    # driver = webdriver.Chrome(options=options, service=Service(ChromeDriverManager().install()))
    service = Service(executable_path='./chromedriver')
    driver = webdriver.Chrome(service=service, options=options)
    print(datetime.today().strftime('%H:%M:%S') + ' tor')
    with open('zuy1', "a") as file:
        file.write(datetime.today().strftime('%Y-%m-%d %H:%M:%S') + ' tor\n')

    # driver.get("https://www.amkamdam.com/")
    # url = "http://da-1.com/test/click-iframe/a.html"
    # url = "https://www.amkamdam.com/test/click-iframe/a.html"
    # url = "https://www.amkamdam.com/"
    # driver.get("https://www.amkamdam.com/test/click-iframe/a.html")
    driver.get("https://www.amkamdam.com/")
    driver.set_window_size(1366, 1200)
    WebDriverWait(driver, 10).until(ec.element_to_be_clickable((By.XPATH, '/html/body/header/div[2]/ul/li[3]/a'))).click()
    # driver.find_element(By.XPATH, "/html/body/header/div[2]/ul/li[3]/a").click()
    # driver.get("https://www.amkamdam.com/news/")
    # driver.set_window_size(1366, 768)
    # driver.set_window_size(1366, 1200)
    # driver.save_screenshot("kak.png")

# driver.get("http://da.com/news/")
    try:
        # driver.switch_to.frame('google_ads_iframe')
        # WebDriverWait(driver, 10).until(ec.element_to_be_clickable((By.XPATH, '//*[@id="abgl"]'))).click()

        # driver.switch_to.frame('google_ads_iframe')
        # driver.find_element(By.XPATH, '/html/body/div/main/section[2]/div/div/div[1]/div[2]/iframe')
        # iframe = driver.find_elements(By.TAG_NAME, 'iframe')[1]

        iframe = driver.find_element(By.CSS_SELECTOR, ".huyslot > iframe")
        driver.switch_to.frame(iframe)
        # driver.find_element(By.XPATH, '/html/body/div/div[2]/a').click()
        WebDriverWait(driver, 10).until(ec.element_to_be_clickable((By.XPATH, '/html/body/div/div[2]/a'))).click()
        WebDriverWait(driver, 10).until(ec.element_to_be_clickable((By.XPATH, '/html/body/div/div[2]/div/a'))).click()
        # driver.save_screenshot("kak1.png")
        # driver.switch_to.default_content()
        # driver.find_element(By.XPATH, "//*[@id=\"header\"]/a").click()

    except Exception as e:
        print(e)
    finally:
        driver.quit()
        # display.stop()


if __name__ == "__main__":
    for i in range(1):
        # while True:
        get_current_ip()
        # renew_tor_ip()
        # time.sleep(3)
