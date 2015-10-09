# takes the input url from the file and tries to parse it 
# if it gets 40 books then removes the url from the file and writes into a success file
# else writes it into an error file.

import time
import urllib.request
import sys
from bs4 import BeautifulSoup

print ("Starting the script")
sys.stdout.flush();
fmain = open("inputtopbooklinks.txt", "r+")
fsuccess = open("inputtopbooklinks_succ.txt","a")
ffail = open("inputtopbooklinks_fail.txt","a")
fbooks = open("bookslinks.txt","a")
i=0;
for line in fmain:
	url = line.rstrip("\n")
	print(i)
	print("\n")
	print("url being processed is "+url+"\n");
	if url == None:
		continue
	page = None
	try :
		page = urllib.request.urlopen(url)
	except Exception as e:
		ffail.write(url + "\n")
		ffail.flush()
		continue
	time.sleep(0.5)
	errorcode = page.getcode()
	if errorcode != 200:
		ffail.write(url + "\n")
		ffail.flush()
		#fmain.truncate(0)
		print( "errorcode " + str(errorcode) + "while accessing url " + url)
		print("-------------------------------------------------------------------")
		continue
	response = page.read()
	#print(response)
	soup = BeautifulSoup(response,'html.parser')
	soup.prettify()
	#print(soup);
	books_pimage = soup.findAll('div',{'class':'product-image'})
	noofbooks = 0
	noofbooks = len(books_pimage)
	sys.stdout.flush()
	if noofbooks != 40:
		ffail.write(url + "\n")
		ffail.flush()
		#fmain.truncate(0)
		print( "errorcode " + str(errorcode) + "while accessing url " + url)
		print("-------------------------------------------------------------------")
		continue
	print("Number of books : "+str(noofbooks))
	for eachbook in range(0,noofbooks):
		book_pimage = books_pimage[eachbook];
		book_link = book_pimage.findAll('a')[0]['href']
		book_link = 'http://www.barnesandnoble.com'+str(book_link);
		fbooks.write(book_link + "\n")
	fsuccess.write(url + "\n")
	fsuccess.flush()
	#fmain.truncate(0)

