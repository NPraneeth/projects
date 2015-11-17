
from collections import Counter

class QGrams(Counter):
    term = ''
    term_ss = ''
    ordered_list = []

    def __init__(self, term, qval=2, start_stop='$#'):
        
        self.term = term
        if len(term) < qval or qval < 1:
            return
        if start_stop and qval > 1:
            term = start_stop[0]*(qval-1) + term + start_stop[-1]*(qval-1)
        self.term_ss = term

        self.ordered_list = [term[i:i+qval] for i in
                             xrange(len(term)-(qval-1))]
        super(QGrams, self).__init__(self.ordered_list)

    def count(self):
        
        return sum(self.values())


q_vals = QGrams("Praneeth",qval=3)
print q_vals.values()
print q_vals