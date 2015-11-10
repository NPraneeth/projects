from bs4 import BeautifulSoup
#import urllib2
import urllib
import urllib.request


items=0
for num in range(0,40,40): #129043):
	url='http://www.barnesandnoble.com/b/computers/_/N-ug4?No='+str(num)+'&Nrpp=40'
	print("URL being read is" + url);
	page = urllib.request.urlopen(url)
	errorcode = page.getcode()
	print( str(errorcode) + " while trying to access url")
	response = page.read()
	#print(response)
	soup = BeautifulSoup(response,'html.parser')
	soup.prettify()
	print(soup);
	books_pimage = soup.findAll('div',{'class':'product-image'})
	noofbooks = len(books_pimage)
	books_pinfo = soup.findAll('div',{'class':'product-info'})
	for eachbook in range(0,noofbooks):
		book_pimage = books_pimage[eachbook];
		book_pinfo = books_pinfo[eachbook];
		book_link = book_pimage.findAll('a')[0]['href']
		book_link = 'http://www.barnesandnoble.com'+str(book_link);
		print ('-----------------------------------------------')
		print (book_link)
		book_name = book_pinfo.findAll('h2')[0].findAll('a')[0].string
		print (book_name)
		book_rating = book_pinfo.findAll('span',{'class':'gig-rating-stars'})[0]['title']
		print (book_rating)




	

	#http://www.barnesandnoble.com/b/computers/_/N-ug4?No='+str(num)+'&Nrpp=40
