
print("HI")


fmain = open("inputtopbooklinks.txt", "r+")
fsuccess = open("inputtopbooklinks_succ.txt","a")
ffail = open("inputtopbooklinks_fail.txt","a")
fbooks = open("bookslinks.txt","a")

fmain.flush()
fsuccess.flush()
ffail.flush()
fbooks.flush()

print("done with flushing")