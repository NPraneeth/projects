import time
import urllib.request
import sys
import glob
import traceback
import csv
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
	bookRowDict = {}
	prodSummarySection = soup.findAll('section',{'id':'prodSummary'})
	if (prodSummarySection != None) and (len(prodSummarySection) > 0):
		prodSummary = prodSummarySection[0]
		#print(prodSummary)
		book_nameSection = prodSummary.findAll('h1',{'itemprop':'name'})#[0].string
		book_name = None
		if (book_nameSection != None) and (len(book_nameSection) > 0):
			book_name = book_nameSection[0].string
		#print(book_name)
		bookRowDict["book_name"]=book_name

		authorsSection = prodSummary.findAll('span',{'class':'contributors'})#[0].findAll('a')
		authors = None
		if (authorsSection != None) and (len(authorsSection) > 0):
			authors = authorsSection[0].findAll('a')
		contributors = '#'.join(author.string for author in authors)
		#print(contributors)
		bookRowDict["contributors"]=contributors
	
		available_formatsSection = prodSummary.findAll('ul',{'id':'availableFormats'})#[0].findAll('li')
		if (available_formatsSection != None) and (len(available_formatsSection) > 0):
			availbale_formats = available_formatsSection[0].findAll('li')
			for format in availbale_formats:
				#print(format)
				formatInfo = format.findAll('a')
				if len(formatInfo)==2:
					book_type = formatInfo[0].string
					book_price = formatInfo[1].string
					if book_price == None:
						book_price = formatInfo[1].findAll('span')[0].string
					 #[0].span.string#.findAll('span',{'itemprop':'price'}).string
					if book_type in ['Paperback','Hardcover','NOOK Book','Audiobook']:
						#print("{} : {}".format(book_type,book_price))
						bookRowDict[book_type]=book_price

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
					#print("{} : {}".format(attName,attValue))
					bookRowDict[attName]=attValue
			except AttributeError as ex:
				continue;
	return bookRowDict


with open("books.csv", "w+",encoding="utf-8",newline='') as csvfile:
	fieldnames = ['filename', 'book_name','contributors','Hardcover','Paperback','NOOK Book','Audiobook','ISBN-13','Series','Publisher','Publication Date','Sales rank','Pages','Product dimensions']
	writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
	writer.writeheader()
	for i in range(0,20):  ##['2']: #
		filetobeparsed = str(i) + ".html"
		#print(filetobeparsed)
		try:
			bookDetails = {}
			soup = get_soup_from_local(filetobeparsed)	
			#soup = get_soup_from_url(url)
			bookDetails = get_data_from_soup(soup)
			bookDetails['filename'] = filetobeparsed
			#print(bookDetails)
			writer.writerow(bookDetails)
			'''
			print("----Dict-----")
			for key,value in bookDetails.items():
				print("{} : {}".format(key,value))
			'''
		except Exception as e:
			#print(e.errno)
			print(filetobeparsed)
			traceback.print_exc(file=sys.stdout)
