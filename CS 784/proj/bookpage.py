from bs4 import BeautifulSoup
import urllib2

url="http://www.barnesandnoble.com/w/rise-of-the-robots-martin-ford/1120177205?ean=9780465059997"
page = urllib2.urlopen(url)
soup = BeautifulSoup(page.read())

