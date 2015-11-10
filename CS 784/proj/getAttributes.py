import time
import urllib.request
import sys
from bs4 import BeautifulSoup

fbooks = open("bookstogetAttrs.txt","r")
booklinks = [line.rstrip("\n") for line in fbooks]

for booklink in booklinks:
	book = urllib.request.urlopen(booklink)
	page = book.read()
	soup = BeautifulSoup(page,'html.parser')
	addProdInfo = soup.find('section',{'id':'additionalProductInfo'})
	#print(addProdInfo)
	attrs = addProdInfo.findAll('dt')
	#print(attrs)

	uniqueAttrs = set()
	for attr in attrs:
		uniqueAttrs.add(attr.string.rstrip(":"))
output = "\n".join(str(e) for e in uniqueAttrs)
print(output)


