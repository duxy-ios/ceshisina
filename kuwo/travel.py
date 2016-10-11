#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import requests
from bs4 import BeautifulSoup
import sys
import os

link=sys.argv[1]
r=requests.get(link)
html=r.text
soup = BeautifulSoup(html,"html5lib")
content=soup.find("div",class_="contentall")
name=soup.find("div",class_="titlemid").h1.get_text()
# print(name)
os.mkdir(name)

img=content.find_all("img",attrs={"data-original": True})
urls=set([])
for im in img:
	picurl=im["data-original"]
	pic=picurl.split("!")[0]
	urls.add(pic)
    # print(im["data-original"])
    
def downPic(urls):
	for url in urls:
		r=requests.get(url)
		picname=url.split("/")[-1]
		with open(name+"/"+picname,"wb") as f:
			for chunk in r.iter_content():
				f.write(chunk)

downPic(urls)	