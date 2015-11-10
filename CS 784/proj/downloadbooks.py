import time
import urllib.request
import sys
from bs4 import BeautifulSoup

print ("Starting the script")
sys.stdout.flush();
fmain = open("booklinkstodownlaod.txt", "r+")
fsuccess = open("downloads_succ.txt","a")
ffail = open("downloads_fail.txt","a")
for line in fmain:
	fnandlink=line.split("-http")
	filetobenamed = fnandlink[0]
	url_to_be_downloaded = "http" + fnandlink[1]
	print(url_to_be_downloaded + " will be downloaded as "+filetobenamed)
	sys.stdout.flush()
	#time.sleep(0.25)
	try:
		urllib.request.urlretrieve(url_to_be_downloaded,"C:/Users/Praneeth/Desktop/bookDownloads/"+filetobenamed+".html")
	except Exception as e:
		ffail.write(line)
		ffail.flush()
		continue
	fsuccess.write(line)
	fsuccess.flush()









#for i in range(4):
#    filename = 'fshared_{}.7z'.format(i)
#    urllib.urlretrieve('http://somewebsite.net/shared/'+filename, filename)