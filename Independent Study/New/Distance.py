
from __future__ import division
import numpy
import sys
import math
from collections import defaultdict, Counter
from Qgram import QGram
from CostFunctions import simCost_plus1_minus0
from CostFunctions import simCost_plus1_minus2
import re  # to use substring replace
try:
    import lzma
except ImportError:  # pragma: no cover
    # If the system lacks the lzma library, that's fine, but lzma comrpession
    # similarity won't be supported.
    pass



SOUNDEXLENGTH = 6

def convert_list_to_set(mylist):
	myset = set()
	for elem in mylist:
		myset.add(elem)
	return myset

def sim_cosine(src, dest, qgraml=None):
    """
    
	    cosine similarity (Ochiai coefficient)
	    For two sets X and Y, the cosine similarity (Ochiai coefficient) is:
	    :math:`sim_{cosine}(X, Y) = \\frac{|X \\cap Y|}{\\sqrt{|X| \\cdot |Y|}}`
	    :param str src, dest: two strings to be compared (or QGrams/Counter objects)
	    :param int qgraml: the length of each q-gram; 0 or None for non-q-gram
	        version
	    :returns: cosine similarity
	    :rtype: float
	    >>> sim_cosine('cat', 'hat')
	    0.5
	    >>> sim_cosine('Niall', 'Neil')
	    0.3651483716701107
	    >>> sim_cosine('aluminum', 'Catalan')
	    0.11785113019775793
	    >>> sim_cosine('ATCG', 'TAGC')
	    0.0
	 }
    """
    if src == dest:
        return 1.0
    if not src or not dest:
        return 0.0

    if isinstance(src, list) and isinstance(dest, list):
        q_src = src
        q_dest = dest
    else:
    	q_src = QGram(src,qgraml)
    	q_dest = QGram(dest,qgraml)
	q_src_set = set(q_src)
	q_dest_set = set(q_dest)
	q_total_set = set(q_src + q_dest)
    q_src_mag = len(q_src_set)
    q_dest_mag = len(q_dest_set)
    q_union_mag = len(q_total_set)
    common_terms = q_src_mag + q_dest_mag - q_union_mag
    return common_terms / math.sqrt(q_src_mag * q_dest_mag)


def dist_cosine(src, dest, qgraml=None):
    return 1 - sim_cosine(src, dest, qgraml)



def dice_sim(src, dest, qgraml=None):
	#returns some value between 0 and 1
	# this is a constant i got from java lib
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
	if isinstance(src,Counter) and isinstance(dest,Counter):
		q_src = src 
		q_dest = dest 
	else:
		q_src = QGram(src,qgraml)
        q_dest = QGram(dest,qgraml)
	q_src_set = set(q_src)
	q_dest_set = set(q_dest)
	q_total_set = set(q_src + q_dest)
	q_src_mag = len(q_src_set)
	q_dest_mag = len(q_dest_set)
	q_union_mag = len(q_total_set)
	common_terms = q_src_mag + q_dest_mag - q_union_mag
	# returns the Dice co-efficient
	return 2.0 * common_terms / (q_src_mag + q_dest_mag);

def dice_dist(src,dest,qgraml=None):
	return 1 - dice_sim(src,dest,qgraml)


def eucledian_dist_sim(src,dest,qgraml=None):
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
	if isinstance(src,list) and isinstance(dest,list):
		q_src = src 
		q_dest = dest 
	else:
		q_src = QGram(src,qgraml)
		q_dest = QGram(dest,qgraml)
	q_src_set = set(q_src)
	q_dest_set = set(q_dest)
	q_src_mag = len(q_src_set)
	q_dest_mag = len(q_dest_set)
	totalPossible = math.sqrt(q_src_mag * q_src_mag + q_dest_mag * q_dest_mag)
	totalDistance = float(0)
	q_alltokens = set(q_src + q_dest)
	for token in q_alltokens:
		countinsrc = 0
		countindest = 0
		for stoken in q_src_set:
			if(stoken == token):
				countinsrc = countinsrc + 1
		for dtoken in q_dest_set:
			if(dtoken == token):
				countindest = countindest+1
		totalDistance = totalDistance + ((countinsrc - countindest)*(countinsrc - countindest))
	totalDistance = math.sqrt(totalDistance)
	return (totalPossible - totalDistance)/totalPossible


def matching_coefficient(src,dest,qgraml=None):
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
	if isinstance(src,list) and isinstance(dest,list):
		q_src = src 
		q_dest = dest 
	else:
		q_src = QGram(src,qgraml)
		q_dest = QGram(dest,qgraml)
	q_src_set = set(q_src)
	q_dest_set = set(q_dest)
	q_src_mag = len(q_src_set)
	q_dest_mag = len(q_dest_set)
	q_total = set(q_src + q_dest)
	q_union_mag = len(q_total)
	maxTokens = max(q_src_mag, q_dest_mag)
	common_terms = q_src_mag + q_dest_mag - q_union_mag
	return common_terms/maxTokens


def qgram_distance(src,dest,qgraml=3):
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
	if isinstance(src,list) and isinstance(dest,list):
		q_src = src 
		q_dest = dest 
	else:
		q_src = QGram(src,qgraml)
		q_dest = QGram(dest,qgraml)
	q_src_set = set(q_src)
	q_dest_set = set(q_dest)
	q_src_mag = len(q_src_set)
	q_dest_mag = len(q_dest_set)
	q_total_set = set(q_src + q_dest)
	
	difference = 0
	for token in q_total_set:
		matchingqgrams1 = 0
 		for stoken in q_src_set:
			if(stoken==token):
				matchingqgrams1 = matchingqgrams1 + 1
		matchingqgrams2 = 0
		for dtoken in q_dest_set:
			if(dtoken == token):
				matchingqgrams2 = matchingqgrams2 + 1
		if matchingqgrams1 > matchingqgrams2:
			difference = difference + (matchingqgrams1 - matchingqgrams2)
		else:
			difference = difference + (matchingqgrams2 - matchingqgrams1)

	totalQGramsMatching = q_src_mag + q_dest_mag
	return (totalQGramsMatching - difference)/totalQGramsMatching

def block_distance(src,dest,qgraml=None):
	return qgram_distance(src,dest,qgraml)


def chapman_length_deviation(src,dest):
	# how should it be handled when either src or dest is None or empyt strings.
	if src==dest or (not src and not dest):
		return 1.0
	len_src = float(len(src))
	len_dest = float(len(dest))
	if(len_src >= len_dest):
		return len_dest/len_src
	else:
		return len_src/len_dest

def chapman_mean_length(src,dest,CHAPMANMEANLENGTHMAXSTRING=500):
	# how to deal with them when either of them is None.
	bothLengths = len(src)+len(dest)
	if bothLengths > CHAPMANMEANLENGTHMAXSTRING:
		return 1.0
	else:
		oneMinusBothScaled = ( CHAPMANMEANLENGTHMAXSTRING - bothLengths )/CHAPMANMEANLENGTHMAXSTRING
		return 1-( oneMinusBothScaled**4)


def calculate_soundex( wordString, soundexLen=6):
	#Make sure the soundex length is in agreeable range
	if wordString is None:
		return ''
	if soundexLen > 10 :
		soundexLen = 10
	if soundexLen < 4 : 
		soundexLen = 4

	#handling empty input - > for empty input return empty output
	if len(wordString) == 0 :
		return ''

	wordString = wordString.upper()
	wordstr = wordString
	wordst = re.sub("[^A-Z]"," ",wordstr)  # replace non chars with spaces
	wordstr = re.sub("\\s+","",wordstr)    # remove spaces

	#handling empty input - > for empty input return empty output
	if len(wordString) == 0 :
		return ''	

	firstLetter = wordstr[0]

	#uses the assumption that enough valid characters are in the first 4 times the soundex required length
	if len(wordstr) > 1+(soundexLen*4):
		wordstr = "-" + wordstr[1:soundexLen*4]
	else :
		wordstr = "-" + wordstr[1:]

	#Begin soundex replace 
	wordstr = re.sub("[AEIOUWH]","0",wordstr)
	wordstr = re.sub("[BPFV]","1",wordstr)
	wordstr = re.sub("[CSKGJQXZ]","2",wordstr)
	wordstr = re.sub("[DT]","3",wordstr)
	wordstr = re.sub("[L]","4",wordstr)
	wordstr = re.sub("[MN]","5",wordstr)
	wordstr = re.sub("[R]","6",wordstr)

	wsLen = len(wordstr)
	lastChar = '-'
	tmpStr = "-"  # replacing skipped first character
	for i in xrange(1, wsLen, 1):
		currChar = wordstr[i]
		if currChar != lastChar:
			tmpStr += currChar
			lastChar = currChar
	wordstr = tmpStr
	wordstr = wordstr[1:]				# Drop first letter
	wordstr = re.sub('0',"",wordstr) 	# remove the zeros
	wordstr += '000000000000000000'		# pad with the zeros
	wordstr = firstLetter+ '-' +wordstr
	wordstr = wordstr[0:soundexLen]		
	return wordstr

def soundex_sim(src,dest):
	soundex1 = calculate_soundex(src, SOUNDEXLENGTH)
	soundex2 = calculate_soundex(dest, SOUNDEXLENGTH)
	return sim_cosine(src,dest)
	# In java implementation instead of using cosine.. he used jaro winkler

def monge_elkan_sim(src,dest,qgraml=None,func=sim_cosine,symmetric=False):
	if src==dest:
		return float(1)
	if not dest or not src:
		return float(0)
	if isinstance(src,list) and isinstance(dest,list):
		q_src = src 
		q_dest = dest 
	else:
		q_src = QGram(src,qgraml)
		q_dest = QGram(dest,qgraml)
	sumMatches = float(0)
	for stoken in q_src:
		maxFound = float(0)
		for dtoken in q_dest:
			found = func(stoken,dtoken,qgraml)
			if found > maxFound:
				maxFound = found
		sumMatches = sumMatches + maxFound
	sim_res = sumMatches/len(q_src)
	if symmetric:
		sim_res = (sim_res+monge_elkan_sim(src,dest,qgraml,func))/2
	return sim_res


#understood the python version and not java version
def needleman_wunch_score(src,dest,gap_cost=2,func=simCost_plus1_minus0):
	if len(src)==0:
		return len(dest)
	if len(dest)==0:
		return len(src)

	d_mat = numpy.zeros((len(src)+1, len(dest)+1), dtype=numpy.float)
    # pylint: enable=no-member

	for i in range(len(src)+1):
		d_mat[i, 0] = i 
	for j in range(len(dest)+1):
		d_mat[0, j] = j
	for i in range(1, len(src)+1):
		for j in range(1, len(dest)+1):
			match = d_mat[i-1, j-1] + func.getCost(src,i-1,dest,j-1)
			delete = d_mat[i-1, j] + gap_cost
			insert = d_mat[i, j-1] + gap_cost
			d_mat[i, j] = min(match, delete, insert)
	return d_mat[d_mat.shape[0]-1, d_mat.shape[1]-1]

def needleman_wunch_sim(src,dest,gap_cost=2,func=simCost_plus1_minus0):
	if src is None or dest is None:
		return float(0)
	#print "i am inside needleman_wunch_sim"
	needleman_wunch = needleman_wunch_score(src,dest,gap_cost,func)
	maxValue = max(len(src),len(dest))
	minValue = maxValue
	if func.getMaxCost() > gap_cost:
		maxValue = maxValue * func.getMaxCost()
	else:
		maxValue = maxValue * gap_cost
	if func.getMinCost() < gap_cost:
		minValue = minValue * func.getMinCost()
	else:
		minValue = minValue * gap_cost
	if minValue < float(0):
		maxValue = maxValue - minValue
		needleman_wunch = needleman_wunch - minValue
	if maxValue == 0:
		return float(1) # as both strings are identically zero length
	else:
		return float(1) - needleman_wunch/maxValue


#should you return the maxsofar or d[m][n]
def smith_waterman_score(src,dest,gap_cost=float(0.5),func=simCost_plus1_minus2):
	src_len = len(src)
	dest_len = len(dest)
	if src_len==0:
		return dest_len
	if dest_len==0:
		return src_len

	d = numpy.zeros((src_len, dest_len), dtype=numpy.float)
    # pylint: enable=no-member
    
	d[0][0]=max(0,-gap_cost,func.getCost(src,0,dest,0))
 	maxsofar = d[0][0]
 	for i in range(1,src_len):
 		d[i][0] = max(0,d[i-1][0]-gap_cost,func.getCost(src,i,dest,0))
 		if maxsofar < d[i][0]:
 			maxsofar = d[i][0]
 	for j in range(1,dest_len):
 		d[0][j] = max(0,d[0][j-1]-gap_cost,func.getCost(src,0,dest,j))
 		if maxsofar < d[0][j]:
 			maxsofar = d[0][j]
 	for i in range(1,src_len):
 		for j in range(1,dest_len):
 			cost = func.getCost(src,i,dest,j)
 			d[i][j] = max(0,d[i-1][j]-gap_cost,d[i][j-1]-gap_cost,d[i-1][j-1]+cost)
 			if maxsofar < d[i][j]:
 				maxsofar = d[i][j]
	return maxsofar

def smith_waterman_sim(src,dest,gap_cost=float(0.5),func=simCost_plus1_minus2):
	if src is None or dest is None:
		return float(0)
	smith_waterman = smith_waterman_score(src,dest,gap_cost,func)
	maxValue = float(min(len(src),len(dest)))
	if func.getMaxCost() > (-1*gap_cost):
		maxValue = maxValue * func.getMaxCost()
	else:
		maxValue = maxValue * -1 * gap_cost
	if maxValue == 0:
		return float(1)  # both are null length strings
	else:
		return smith_waterman/maxValue


#this is from the python package
#This seems to be correct than the one in the java package
def smith_waterman(src, dest, gap_cost=float(0.5), func=simCost_plus1_minus2):
    
    # pylint: disable=no-member
    d_mat = numpy.zeros((len(src)+1, len(dest)+1), dtype=numpy.float)
    # pylint: enable=no-member

    for i in range(len(src)+1):
        d_mat[i, 0] = 0
    for j in range(len(dest)+1):
        d_mat[0, j] = 0
    for i in range(1, len(src)+1):
        for j in range(1, len(dest)+1):
            match = d_mat[i-1, j-1] + func.getCost(src,i-1,dest,j-1)
            delete = d_mat[i-1, j] - gap_cost
            insert = d_mat[i, j-1] - gap_cost
            d_mat[i, j] = max(0, match, delete, insert)
            print d_mat[i,j]
    return d_mat[d_mat.shape[0]-1, d_mat.shape[1]-1]





























def chapman_orderedname_compound_sim(func1,func2,src,dest,qgrams=2):
	#soundex and smith waterman are used in java implementation
	# we have extended our suppor to change the functions.
	ESTIMATEDTIMINGCONST = float(0.026571428571428571428571428571429)
	if isinstance(src,Counter) and isinstance(dest,Counter):
		q_src = src 
		q_dest = dest 
	elif qgraml and qgraml >0:
		print(" In qgrams")
		q_src = QGrams(src,qgram1)
		q_dest = QGrams(dest,qgraml)
	else:
		q_src = Counter(src.strip().split())
		q_dest = Counter(dest.strip().split())
	q_src_mag = sum(q_src.values())
	q_dest_mag = sum(q_dest.values())
	minTokens = math.min(q_src_mag, q_dest_mag)
	SKEW_AMOUNT = float(1)
	sumMatches = float(0)
	for i in xrange(1,minTokens+1,1):
		strWeightingAdjustment = ((float(1)/minTokens)+(((((minTokens-i)+float(0.5))-(minTokens/float(2)))/minTokens)*SKEW_AMMOUNT*(float(1)/minTokens)));
		sToken = q_src[q_src_mag - i]
		tToken = q_dest[q_dest_mag - i]
		found1 = func1(src,dest,qgram)
		found2 = func2(src,dest,qgram)
		sumMatches += ((float(0.5) * (found1+found2)) * strWeightingAdjustment)
	return sumMatches








































'''

	#  (((str1Tokens + str2Tokens) * str1Tokens) + ((str1Tokens + str2Tokens) * str2Tokens)) * ESTIMATEDTIMINGCONST
print("Starting ...")
eucledian_dist_sim("am i good good","bad bad i am",qgraml=-1)

'''