
from __future__ import division
import numpy
import sys
import math
from collections import defaultdict, Counter
from Qgram import QGram
from CostFunctions import simCost_plus0_plus1 
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
    
	    cosine similarity 
	    For two lists X and Y, the cosine similarity (Ochiai coefficient) is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: cosine similarity
	    :rtype: float
	    >>> sim_cosine('Test String1','Test String2',qgraml=3)
	    0.7857142857142857
	    >>> sim_cosine('University of Wisconsin Madison','UW Madison')  
	    0.35355339059327373
	 
    """
    if src == dest:
        return float(1)
    if not src or not dest:
        return float(0)

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
	"""
	    distance in cosine similarity 
	    For two lists X and Y, the distance in cosine similarity (Ochiai coefficient) is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '1' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: cosine similarity
	    :rtype: float
	    >>> sim_cosine('Test String1','Test String2',qgraml=3)
	    1-0.7857142857142857
	    >>> sim_cosine('University of Wisconsin Madison','UW Madison')  
	    1-0.35355339059327373
    """
	return 1 - sim_cosine(src, dest, qgraml)


def dice_sim(src, dest, qgraml=None):
	"""
	    Dice similarity 
	    For two lists X and Y, the Dice similarity  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: Dice similarity
	    :rtype: float
	    >>> dice_sim('I am a good boy','am I a good boy',qgraml=None)
	    1
	    >>> dice_sim(Test String1','Test String2',qgraml=3)
	    0.7857142857142857
	"""
	#returns some value between 0 and 1
	# this is a constant i got from java lib
	if src==dest :
		return float(1)
	if not src or not dest:				#if one of them is null then it return 0
		return float(0)
	if isinstance(src,list) and isinstance(dest,list):
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
	"""
    
	    Dice distance 
	    For two lists X and Y, the Dice distance  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '1' distance is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: Dice distance
	    :rtype: float
	    >>> dice_sim('I am a good boy','am I a good boy',qgraml=None)
	    0
	    >>> dice_sim(Test String1','Test String2',qgraml=3)
	    0.2142857142857143
	 
    """
	return 1 - dice_sim(src,dest,qgraml)


def eucledian_dist_sim(src,dest,qgraml=None):
	"""
	 	    Eucledian similarity 
	    For two lists X and Y, the Eucledian similarity  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: Eucledian similarity
	    :rtype: float
	    >>> eucledian_dist_sim('I am a good boy','am I a good boy',qgraml=None)
	    1
	    >>> eucledian_dist_sim('Test String1','Test String2',qgraml=3)
		0.8762820851736516
	 
	"""
	if src==dest :
		return float(1)
	if not src or not dest:				#if one of them is null then it return 0
		return float(0)
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
	"""
    
	    Matching coefficient similarity 
	    For two lists X and Y, the Matching coefficient similarity  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: Matching coefficient similarity
	    :rtype: float
	 
    """
	if src == dest:
		return float(1)
	if not src or not dest:				#if one of them is null then it return 0
		return float(0)
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
	"""
    
	    QGram Distance similarity 
	    For two lists X and Y, the QGram Distance similarity  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is '3'.
	    :returns: QGram Distance similarity
	    :rtype: float
	 	>>>qgram_distance('Test String1','Test String2',qgraml=None)
	 	0.5
	 	>>>qgram_distance('Test String1','Test String2')
	 	0.7857142857142857

    """
	if src == dest:
		return float(1.0)
	if not src or not dest:				#if one of them is null then it return 0
		return float(0.0)
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
	"""
    
	    Block Distance similarity 
	    For two lists X and Y, the Block Distance similarity  is:
	    :param str src, dest: two strings to be compared (or QGrams/list of qgrams)
	    					  if src or dest is None , a '0' similarity is returned.
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :returns: Block Distance similarity
	    :rtype: float
	 	>>>block_distance('Test String1','Test String2')
	 	0.5

    """
	return qgram_distance(src,dest,qgraml)


def chapman_length_deviation(src,dest):
	"""
    
	    Chapman Length Deviation
	    For two lists X and Y, the Chapman Length Deviation is:
	    :param str src, dest: two strings to be compared 
	    					  if src or dest is None , a '0' similarity is returned.
	    :returns: Chapman Length Deviation
	    :rtype: float
	 	>>>chapman_length_deviation('Test String1','Test String2')
	 	1
		>>>chapman_length_deviation('University of Wisconsin - Madison','UW - Madison')
		0.36363636363636365

	 """
	# how should it be handled when either src or dest is None or empyt strings.
	if src==dest: 
		return float(1)
	if not src or not dest:
		return float(0)
	len_src = float(len(src))
	len_dest = float(len(dest))
	if(len_src >= len_dest):
		return len_dest/len_src
	else:
		return len_src/len_dest

def chapman_mean_length(src,dest,CHAPMANMEANLENGTHMAXSTRING=500):
	"""
    
	    Chapman Mean Length 
	    For two lists X and Y, the Chapman Mean Length is:
	    :param str src, dest: two strings to be compared 
	    					  if src or dest is None , a '0' similarity is returned.
	    :param CHAPMANMEANLENGTHMAXSTRING ( optional ) : This should be an integer
	    				which approxiamates to the mean string length.'500' as default.
	    :returns: Chapman Mean Length
	    :rtype: float
	 	>>>chapman_mean_length('Test String1','Test String2',CHAPMANMEANLENGTHMAXSTRING=500)
	 	0.1786130595840002
		>>>chapman_length_deviation('University of Wisconsin - Madison','UW - Madison')
		0.36363636363636365
	"""

	# how to deal with them when either of them is None.
	bothLengths = len(src)+len(dest)
	if bothLengths > CHAPMANMEANLENGTHMAXSTRING:
		return 1.0
	else:
		oneMinusBothScaled = ( CHAPMANMEANLENGTHMAXSTRING - bothLengths )/CHAPMANMEANLENGTHMAXSTRING
		return 1-( oneMinusBothScaled**4)


def calculate_soundex( wordString, soundexLen=6):
	"""
    
	    Calculate Soundex
	    For a give word, the Calculate Soundex does:
	    :param str wordString : one string for which the Soundex has to be computed. 
	    :param soundexLen ( optional ) : This should be an integer between 4 and 10
	    				which approxiamates to the length of Soundex you want.
	    				If not specified the default value, '6' is considered.
	    :returns: Soundex String of a given word
	    :rtype: string
	 	>>>calculate_soundex('University of Wisconsin Madison',6)University
	 	U-5162
	 	>>>calculate_soundex('Test String1',6)
	 	T-2323

	"""
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

def soundex_sim(src,dest,func=sim_cosine):
	"""
    
	    Soundex Similarity
	    For give 'src' and 'dest' strings, the Soundex Similarity:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param function func( optional ) : A function can be given as argument. The function
	    		given as input should take two strings and return the normalized similarity. 
	    :returns: return type of the given func ( Cosine Similarity by default. )
	    :rtype: float. ( the function should provided as argument should be able to return 
	    				float as similarity for given two strings. )

	"""
	soundex1 = calculate_soundex(src, SOUNDEXLENGTH)
	soundex2 = calculate_soundex(dest, SOUNDEXLENGTH)
	return sim_cosine(src,dest,qgraml=2)
	# In java implementation instead of using cosine.. he used jaro winkler

def monge_elkan_sim(src,dest,qgraml=None,func=sim_cosine,symmetric=False):
	"""
    
	    Monge Elkan Similarity
	    For give 'src' and 'dest' strings, the Monge Elkan Similarity:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int qgraml: the length of each q-gram; None for non-q-gram
	        				The default qgraml if not given is None.
	    :param function func( optional ) : A function can be given as argument. The function
	    		given as input should take two qgrams/words and return the normalized similarity.
	    :param boolean symmetric : this should specify 'True' or 'False'. If symmetric then
	    		the function executes with interchanging src and dest and then giving the mean similarity. 
	    :returns: return type of the given func ( Cosine Similarity by default. )
	    :rtype: float. ( the function should provided as argument should be able to return 
	    				float as similarity for given two strings. )
		>>>monge_elkan_sim('Test String1','Test String2',qgraml=None,func=sim_cosine,symmetric=False)
		0.5

	"""
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
def needleman_wunch_score(src,dest,gap_cost=2,costFuncClass=simCost_plus0_plus1):
	"""
    
	    Needleman Wunch Score ( Unnormalized Similarity )
	    This function is used to generate the Needleman Wunch Normalized Similarity.
	    For give 'src' and 'dest' strings, the Needleman Wunch Score:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int gap_cost: This should be an integer input. This is the cost given for a gap.
	    					The default value is '2'
	    :param class costFuncClass( optional ) : A class which is specified as CostFunctions can be given.
	    			Currently we have 2 CostFunctions : simCost_plus0_plus1, simCost_plus1_minus2
	    			If not specified simCost_plus0_plus1 is used as default.
	    :returns: Needleman Wunch Score
	    :rtype: int
		>>>needleman_wunch_score('GCATGCU','GATTACA',gap_cost=2,class=simCost_plus0_plus1)
		4
		>>>needleman_wunch_score('University of Wisconsin Madison','UW Madison')
		23

	"""
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
			match = d_mat[i-1, j-1] + costFuncClass.getCost(src,i-1,dest,j-1)
			delete = d_mat[i-1, j] + gap_cost
			insert = d_mat[i, j-1] + gap_cost
			d_mat[i, j] = min(match, delete, insert)
	return d_mat[d_mat.shape[0]-1, d_mat.shape[1]-1]

def needleman_wunch_sim(src,dest,gap_cost=2,costFuncClass=simCost_plus0_plus1):
	"""
    
	    Needleman Wunch Similarity:
	    For give 'src' and 'dest' strings, the Needleman Wunch Similarity:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int gap_cost: This should be an integer input. This is the cost given for a gap.
	    					The default value is '2'
	    :param class costFuncClass( optional ) :A class which is specified as CostFunctions can be given.
	    			Currently we have 2 CostFunctions : simCost_plus0_plus1, simCost_plus1_minus2
	    			If not specified simCost_plus0_plus1 is used as default.
	    :returns: Needleman Wunch Similarity
	    :rtype: float
		>>>needleman_wunch_score('GCATGCU','GATTACA',gap_cost=2,costFuncClass=simCost_plus0_plus1)
		0.7142857142857143
		>>>needleman_wunch_score('University of Wisconsin Madison','UW Madison')
		0.62903225806451613

	"""
	if src is None or dest is None:
		return float(0)
	#print "i am inside needleman_wunch_sim"
	needleman_wunch = needleman_wunch_score(src,dest,gap_cost,costFuncClass)
	maxValue = max(len(src),len(dest))
	minValue = maxValue
	if costFuncClass.getMaxCost() > gap_cost:
		maxValue = maxValue * costFuncClass.getMaxCost()
	else:
		maxValue = maxValue * gap_cost
	if costFuncClass.getMinCost() < gap_cost:
		minValue = minValue * costFuncClass.getMinCost()
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
	"""
    
	    Smith Waterman Score ( Unnormalized Similarity )
	    This function is used to generate the Smith Waterman Normalized Similarity.
	    For give 'src' and 'dest' strings, the Smith Waterman Score:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int gap_cost: This should be a float value. This is the cost given for a gap.
	    					The default value is '0.5'
	    :param class costFuncClass( optional ) : A class which is specified as CostFunctions can be given.
	    			Currently we have 2 CostFunctions : simCost_plus0_plus1, simCost_plus1_minus2
	    			If not specified simCost_plus1_minus2 is used as default.
	    :returns: Smith Waterman Score
	    :rtype: float
	    >>>smith_waterman_score('University of Wisconsin Madison','UW Madison')
	    8
		>>>smith_waterman_score('Test String1','Test String2')
		11

	"""
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
	"""
    
	    Smith Waterman Similarity:
	    For give 'src' and 'dest' strings, the Smith Waterman Similarity:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int gap_cost: This should be a float value. This is the cost given for a gap.
	    					The default value is '0.5'
	    :param class costFuncClass( optional ) : A class which is specified as CostFunctions can be given.
	    			Currently we have 2 CostFunctions : simCost_plus0_plus1, simCost_plus1_minus2
	    			If not specified simCost_plus1_minus2 is used as default.
	    :returns: Smith Waterman Similarity
	    :rtype: float
		>>>smith_waterman_sim('GCATGCU','GATTACA')
		0.35714285714285715
		>>>smith_waterman_sim('University of Wisconsin Madison','UW Madison')
		0.80000000000000004

	"""
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
    """
    
	    Smith Waterman Score ( Unnormalized Similarity )
	    This function is used to generate the Smith Waterman Normalized Similarity.
	    For give 'src' and 'dest' strings, the Smith Waterman Score:
	    :param str src : first string to be compared to
	    :param str dest : second string to compare with
	    :param int gap_cost: This should be a float value. This is the cost given for a gap.
	    					The default value is '0.5'
	    :param class costFuncClass( optional ) : A class which is specified as CostFunctions can be given.
	    			Currently we have 2 CostFunctions : simCost_plus0_plus1, simCost_plus1_minus2
	    			If not specified simCost_plus1_minus2 is used as default.
	    :returns: Smith Waterman Score
	    :rtype: float
	    >>>smith_waterman('University of Wisconsin Madison','UW Madison')
	    8
		>>>smith_waterman('Test String1','Test String2')
		11
	"""

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






def chapman_orderedname_compound_sim(src,dest,func1=soundex_sim,func2=smith_waterman_sim,qgraml=None):
	#soundex and smith waterman are used in java implementation
	# we have extended our suppor to change the functions.
	if src==dest :
		return float(1)
	if not src or not dest:				#if one of them is null then it return 0
		return float(0)
	if isinstance(src,list) and isinstance(dest,list):
		q_src = src 
		q_dest = dest
	else:
		q_src = QGram(src,qgraml)
		q_dest = QGram(dest,qgraml)
	q_src_mag = len(q_src)
	q_dest_mag = len(q_dest)
	minTokens = min(q_src_mag, q_dest_mag)
	SKEW_AMOUNT = float(1)
	sumMatches = float(0)
	for i in xrange(1,minTokens+1,1):
		strWeightingAdjustment = ((float(1)/minTokens)+(((((minTokens-i)+float(0.5))-(minTokens/float(2)))/minTokens)*SKEW_AMOUNT*(float(1)/minTokens)));
		sToken = q_src[q_src_mag - i]
		tToken = q_dest[q_dest_mag - i]
		found1 = func1(sToken,tToken)
		found2 = func2(sToken,tToken)
		sumMatches += ((float(0.5) * (found1+found2)) * strWeightingAdjustment)
	return sumMatches

	'''
	To do :

	Soundex should eventually implement JaroWinkler as base functions

	'''








































'''

	#  (((str1Tokens + str2Tokens) * str1Tokens) + ((str1Tokens + str2Tokens) * str2Tokens)) * ESTIMATEDTIMINGCONST
print("Starting ...")
eucledian_dist_sim("am i good good","bad bad i am",qgraml=-1)

'''