#!/home/al/.venv/bin/python3
import glob2
from bs4 import BeautifulSoup
import requests
import time
from pathlib import Path
import os
import shutil
from datetime import datetime
import unittest
import re

# https://beautiful-soup-4.readthedocs.io/en/latest/

start_time = time.time()
todaytime = datetime.today().strftime('%Y-%m-%d %H:%M:%S')


def replace_header_footer(read_file1):
    with open('./me-index.html', 'r') as file1:
        soup = BeautifulSoup(file1.read(), features="html.parser")

    head = soup.find("head")
    header = soup.find("header")
    footer = soup.find("footer")

    soup1 = BeautifulSoup(read_file1, features="html.parser")

    head1 = soup1.find("head")
    if head1:
        head1.replace_with(head)

    header1 = soup1.find("header")
    if header1:
        header1.replace_with(header)

    footer1 = soup1.find("footer")
    if footer1:
        footer1.replace_with(footer)

    return str(soup1)


def replace_links(read_file1):
    # replace = [
    #     ['https://cryptonews.com', ''],
    #     ['xxx', 'yyy']
    # ]

    soup = BeautifulSoup(read_file1, features="html.parser")
    links = soup.find_all('a')
    # for r in replace:
    for link in links:
        href = link.get('href')
        if href:
            if 'https://cryptonews.com' in href:
                href = href.replace('https://cryptonews.com', '')
                link['href'] = href

            if 'https://kumkanot.com' in href:
                href = href.replace('https://kumkanot.com', '')
                link['href'] = href

            if '/ext/' in href:
                href = href.replace('/ext/', 'https://cryptonews.com/ext/')
                link['href'] = href

    return str(soup)


def download_files(url, path, file1):
    time.sleep(1)

    try:
        headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.125 Safari/537.36'}
        source = requests.get(url, headers=headers, timeout=None)

        Path(path).mkdir(parents=True, exist_ok=True)
        with open(path + file1, "w") as f:
            f.write(source.text)

    except Exception as e:
        print(e)
        pass


def download_json_files(read_file1):
    # print('kak')
    soup = BeautifulSoup(read_file1, features="html.parser")
    soup1 = soup.find_all("a")
    for link in soup1:
        # print(link)
        loadmoretype = link.get('loadmoretype')
        if loadmoretype:
            url = 'https://cryptonews.com/paged/' + loadmoretype + '-1.json'
            print(url)
            path = './a/cryptonews.com/paged/'
            file1 = loadmoretype + '-1.json'
            download_files(url, path, file1)


def decompose_tags(read_file1):
    soup = BeautifulSoup(read_file1, features='html.parser')

    newsletter = soup.find('div', class_='newsletter')
    if newsletter:
        newsletter.decompose()

    iframes = soup.findAll('iframe')
    for iframe in iframes:
        if iframe:
            iframe.parent.decompose()

    widget_containers = soup.findAll('div', id='widget_container')
    for widget_container in widget_containers:
        if widget_container:
            widget_container.decompose()

    scripts = soup.findAll('script')
    for script in scripts:
        if script:
            script.decompose()

    socials = soup.findAll('div', class_='socials')
    for social in socials:
        if social:
            social.decompose()

    twitter = soup.find_all("h2")
    for t in twitter:
        if 'Twitter' in t.text:
            t.decompose()

    tags_links = soup.find_all("a")
    for t in tags_links:
        if '/tags/' in t['href']:
            t.decompose()

    return str(soup)


def insert_ads(read_file1):
    with open('./me-index.html', 'r') as file1:
        soup = BeautifulSoup(file1.read(), features="html.parser")

    soup1 = BeautifulSoup(read_file1, features='html.parser')

    for dslot in soup1.findAll('div', class_='dslot'):
        for medslot in soup.findAll('div', class_='dslot'):
            if dslot.get('did') == medslot.get('did'):
                dslot.replace_with(medslot)

    return str(soup1)


def replace_text(read_file1):
    read_file1 = read_file1.replace('cryptonews', 'kumkanot')
    read_file1 = read_file1.replace('Cryptonews', 'Kumkanot')
    read_file1 = read_file1.replace('CryptoNews', 'Kumkanot')
    read_file1 = read_file1.replace('CRYPTONEWS', 'KUMKANOT')
    read_file1 = read_file1.replace('Crypto News', 'Kumkanot')

    return read_file1


# find and replace string
files = ['html', 'htm']
# files = ['php']
# files = ['json']
countreplace = 1

for fl in files:
    for filepath in glob2.iglob('./a/cryptonews.com/**/*.' + fl, recursive=True):
        print(str(countreplace) + ' ' + filepath)
        with open(filepath) as file:
            read_file = file.read()

        # download_json_files(read_file)
        read_file = replace_text(read_file)
        read_file = replace_links(read_file)
        read_file = decompose_tags(read_file)
        read_file = replace_header_footer(read_file)
        read_file = insert_ads(read_file)

        countreplace = countreplace + 1

        with open(filepath, "w") as file:
            file.write(read_file)

shutil.copytree('./a/cryptonews.com', './public_html', dirs_exist_ok=True)
shutil.copytree('./replace', './public_html', dirs_exist_ok=True)

finish_time = time.time() - start_time
finish_time = round(finish_time / 60, 2)

print('copied ' + str(countreplace) + ' files, time taken ' + str(finish_time) + ' min')

with open('count_replace.txt', "a") as file:
    file.write(todaytime + ' files ' + str(countreplace) + ', time ' + str(finish_time) + ' min\n')

ha = None
