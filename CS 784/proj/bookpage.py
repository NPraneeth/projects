import time
import urllib.request
import sys
from bs4 import BeautifulSoup

url="http://www.barnesandnoble.com/w/rise-of-the-robots-martin-ford/1120177205?ean=9780465059997"

def get_soup_from_url(url):
	page = urllib.request.urlopen(url)
	soup = BeautifulSoup(page.read(),'html.parser')
	soup.prettify();
	return soup

def get_data_from_soup(soup):
	prodSummary = soup.findAll('section',{'id':'prodSummary'})[0]
	book_name = prodSummary.findAll('h1',{'itemprop':'name'})[0].string
	print(book_name)
	authors = prodSummary.findAll('span',{'class':'contributors'})[0].findAll('a')
	contributors = '#'.join(author.string for author in authors)
	print(contributors)
	availbale_formats = prodSummary.findAll('ul',{'id':'availableFormats'})[0].findAll('li')
	for format in availbale_formats:
		#print(format)
		book_type = format.findAll('a')[0].string
		book_price = format.findAll('a')[1].findAll('span')[0].string
		 #[0].span.string#.findAll('span',{'itemprop':'price'}).string
		print(book_type)
		print(book_price)
	review_status_box = soup.findAll('div',{'class':'review-status-box'})[0]
	avg_review_cont = review_status_box.find('p').find('span').string
	prod_review_info = review_status_box.find('div',{'class':'prodReviewInfo'})
	prod_rating = prod_review_info.find('p',{'class':'avg-review-container'}).find('span',{'class':'gig-average-review'}).string
	prod_noof_reviews = prod_review_info.find('a',{'class':'gig-rating-readReviewsLink'}).string
	#prodDetails = soup.findAll('section',{'id':'additionalProductInfo'})[0]
	print(prod_rating)
	print(prod_noof_reviews)



	
soup = get_soup_from_url(url)
name = get_data_from_soup(soup)
print(name);
