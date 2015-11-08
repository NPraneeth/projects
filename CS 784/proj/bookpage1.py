import time
import urllib.request
import sys
import glob
import traceback
from bs4 import BeautifulSoup

url="http://www.barnesandnoble.com/w/rise-of-the-robots-martin-ford/1120177205?ean=9780465059997"

def get_soup_from_url(url):
	page = urllib.request.urlopen(url)
	soup = BeautifulSoup(page.read(),'html.parser')
	soup.prettify();
	return soup

def get_soup_from_local(localurl):
	f = open("C:/Users/Praneeth/Desktop/bookDownloads/sample/"+localurl,"r+",encoding="utf-8")
	#print(f)
	soup = BeautifulSoup(f,'html.parser')
	soup.prettify();
	return soup

def get_data_from_soup(soup):
	prodSummarySection = soup.findAll('section',{'id':'prodSummary'})
	if (prodSummarySection != None) and (len(prodSummarySection) > 0):
		prodSummary = prodSummarySection[0]
		#print(prodSummary)
		book_nameSection = prodSummary.findAll('h1',{'itemprop':'name'})#[0].string
		book_name = None
		if (book_nameSection != None) and (len(book_nameSection) > 0):
			book_name = book_nameSection[0].string
		print(book_name)
		authorsSection = prodSummary.findAll('span',{'class':'contributors'})#[0].findAll('a')
		authors = None
		if (authorsSection != None) and (len(authorsSection) > 0):
			authors = authorsSection[0].findAll('a')
		contributors = '#'.join(author.string for author in authors)
		print(contributors)
	
		available_formatsSection = prodSummary.findAll('ul',{'id':'availableFormats'})#[0].findAll('li')
		if (available_formatsSection != None) and (len(available_formatsSection) > 0):
			availbale_formats = available_formatsSection[0].findAll('li')
			for format in availbale_formats:
				#print(format)
				formatInfo = format.findAll('a')
				if len(formatInfo)==2:
					book_type = formatInfo[0].string
					book_price = formatInfo[1].findAll('span')[0].string
					 #[0].span.string#.findAll('span',{'itemprop':'price'}).string
					if book_type in ['Paperback','Hardcover','NOOK Book','Audiobook']:
						print("{} : {}".format(book_type,book_price))
	productDetails = soup.find('div',{'id':'ProductDetailsTab'})
	if productDetails != None:
		prodAttrs = productDetails.findAll('dt')
		prodValuesComp = productDetails.findAll('dd')
		prodValues = []
		for prodValue in prodValuesComp:
			value = prodValue.find('a');
			if value != None:
				prodValues.append(value.string)
			else:
				prodValues.append(prodValue)

		for i,j in zip(prodAttrs,prodValues):
			#print(i.string)
			#print(j.string)
			try:
				attName = i.string.rstrip(":").rstrip(" ")
				attValue = j.string.rstrip(" ").rstrip("\n").lstrip(" ")
				if attName in ['ISBN-13','Publisher','Publication Date','Product dimensions','Series','Pages','Sales rank']:
					print("{} : {}".format(attName,attValue)) 
			except AttributeError as ex:
				continue;


for i in range(0,20):
	filetobeparsed = str(i) + ".html"
	print(filetobeparsed)
	try:
		soup = get_soup_from_local(filetobeparsed)	
		#soup = get_soup_from_url(url)
		get_data_from_soup(soup)
	except Exception as e:
		#print(e.errno)
		traceback.print_exc(file=sys.stdout)
	finally:
		print("---------------------------------------------");
   	
