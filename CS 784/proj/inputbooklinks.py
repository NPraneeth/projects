#All the top level book links generation


import urllib
import urllib.request


myfile = open("inputtopbooklinks.txt","a")
for num in range(0,130000,40): #129043):
	url='http://www.barnesandnoble.com/b/computers/_/N-ug4?No='+str(num)+'&Nrpp=40'
	myfile.write(url + "\n")