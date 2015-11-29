
class QGram(list):

    def __init__(self, term, qval=2, start_stop='$#'):
        
        self.term = term
        if len(term) < qval or qval < 1:
            super(QGram,self).__init__(term.split())
            return
        if start_stop and qval > 1:
            term = start_stop[0]*(qval-1) + term + start_stop[-1]*(qval-1)
        self.term_ss = term

        self.ordered_list = [term[i:i+qval] for i in
                             xrange(len(term)-(qval-1))]
        super(QGram,self).__init__(self.ordered_list)
        
        #super(QGrams, self).__init__(self.ordered_list)

    def count(self):
        return len(self.ordered_list)


def convert_list_to_set(mylist):
    myset = set()
    for elem in mylist:
        myset.add(elem)
    return myset 

'''
q_src = QGram("PraneethPraneethPraneeth",2)
print q_src
q_src_set1 = set(q_src)
print q_src_set1
print len(q_src_set1)
q_src_set = convert_list_to_set(q_src)
print q_src_set

q_dest = QGram("Praneeth Naramsetti",None)
print q_dest

q_test1 = QGram("pran",6)
print q_test1
'''
