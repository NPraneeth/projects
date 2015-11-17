

import numpy
import sys
import math
from collections import defaultdict, Counter
import qgram
import re  # to use substring replace
try:
    import lzma
except ImportError:  # pragma: no cover
    # If the system lacks the lzma library, that's fine, but lzma comrpession
    # similarity won't be supported.
    pass

SOUNDEXLENGTH = 6

def sim_cosine(src, dest, qgraml=2):
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

    if isinstance(src, Counter) and isinstance(dest, Counter):
        q_src = src
        q_dest = dest
    elif qgraml and qgraml > 0:
        q_src = QGrams(src, qgraml)
        q_dest = QGrams(dest, qgraml)
    else:
        q_src = Counter(src.strip().split())
        q_dest = Counter(dest.strip().split())
    q_src_mag = sum(q_src.values())
    q_dest_mag = sum(q_dest.values())
    q_intersection_mag = sum((q_src & q_dest).values())

    return q_intersection_mag / math.sqrt(q_src_mag * q_dest_mag)


def dist_cosine(src, dest, qgraml=2):
    return 1 - sim_cosine(src, dest, qgraml)


    
def dice_sim(src, dest, qgraml=2):
	#returns some value between 0 and 1
	# this is a constant i got from java lib
	ESTIMATEDTIMINGCONST = float(0.00000038337142857142857142857142857142)
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
	if isinstance(src,Counter) and isinstance(dest,Counter):
		q_src = src 
		q_dest = dest 
	elif qgraml and qgraml >0:
		q_src = QGrams(src,qgram1)
		q_dest = QGrams(dest,qgraml)
	else:
		q_src = Counter(src.strip().split())
		q_dest = Counter(dest.strip().split())
	q_src_mag = sum(q_src.values())
	q_dest_mag = sum(q_dest.values())
	q_intersection_mag = sum((q_src & q_dest).values())
	# returns the Dice co-efficient
	return 2.0 * q_intersection_mag / (q_src_mag + q_dest_mag);

def dice_dist(src,dest,qgraml=2):
	return 1 - dice_sim(src,dest,qgraml)



def eucledian_dist_sim(src,dest,qgraml=2):
	ESTIMATEDTIMINGCONST = float(7.4457142857142857142857142857146e-5)
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
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
	q_total = q_src + q_dest
	totalDistance = 0
	for key in q_total:
		#print("in a : " + str(q_src[key]))
		#print("in b : " + str(q_dest[key]))
		#print("in total : " + str(q_total[key]))
		totalDistance = totalDistance + (q_src[key]-q_dest[key])*(q_src[key]-q_dest[key])
	#print totalDistance
	totalPossible = math.sqrt(q_src_mag * q_src_mag + q_dest_mag * q_dest_mag)
	totalDistance = math.sqrt(totalDistance)
	#print((totalPossible - totalDistance)/totalPossible)
	return (totalPossible - totalDistance)/totalPossible


def matching_coefficient(src,dest,qgraml=2):
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
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
	maxTokens = math.max(q_src_mag, q_dest_mag)
	q_intersection = q_src & q_dest
	q_intersection_mag = sum(q_intersection.values())
	return q_intersection_mag/maxTokens


def qgram_distance(src,dest,qgraml=2):
	if src == dest:
		return 1.0
	if not src or not dest:				#if one of them is null then it return 0
		return 0.0
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
	q_total = q_src + q_dest
	difference = 0
	for key in q_total:
		#print("in a : " + str(q_src[key]))
		#print("in b : " + str(q_dest[key]))
		#print("in total : " + str(q_total[key]))
		difference = difference + math.fabs(q_src[key]-q_dest[key])
	maxQGramsMatching = q_src_mag + q_dest_mag
	return (maxQGramsMatching - difference)/maxQGramsMatching



def block_distance(src,dest):
	
	## QGram Distance and Block distance looks same to me. Hence stopped implementation
	return qgram_distance(src,dest,qgraml=-1)


def chapman_length_deviation(src,dest):
	len_src = len(src)
	len_dest = len(dest)
	if(len_src >= len_dest):
		return len_dest/len_src
	else:
		return len_src/len_dest

def chapman_mean_length(src,dest):
	#defines the internal max string length beyond which 1.0 is always returned.
	CHAPMANMEANLENGTHMAXSTRING = 500;
	bothLengths = len(src)+len(dest)
	if(bothLenghts > CHAPMANMEANLENGTHMAXSTRING):
		return 1.0
	else:
		oneMinusBothScaled = ( CHAPMANMEANLENGTHMAXSTRING - bothLenghts )/CHAPMANMEANLENGTHMAXSTRING
		return 1-( oneMinusBothScaled**4)
		# I have no clue what is happening.. i just imitated java lib


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

def chapman_matching_soundex(src,dest):
	ESTIMATEDTIMINGCONST = float(0.026571428571428571428571428571429)
	# this actually extends MongeElkan - yet to be implemented



def calculate_soundex( wordString, soundexLen):
	#Make sure the soundex length is in agreeable range
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
	if len(wordstr) > 1+(SOUNDEX*4):
		wordstr = "-" + wordstr[1:SOUNDEXLENGTH*4]
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
		if curChar != lastChar:
			tmpStr += currChar
			lastChar = currChar
	wordstr = tmpStr
	wordstr = wordstr[1:]				# Drop first letter
	wordstr = re.sub('0',"",wordstr) 	# remove the zeros
	wordStr += "000000000000000000"		# pad with the zeros
	wordstr = firstLetter+ "-" +wordstr
	wordstr = wordstr[0:soundexLen]		
	return wordstr


def soundex_sim(src,dest):
	soundex1 = calculate_soundex(src, SOUNDEXLENGTH)
	soundex2 = calculate_soundex(dest, SOUNDEXLENGTH)
	return sim_cosine(src,dest)
	# In java implementation instead of using cosine.. he used jaro winkler




	#  (((str1Tokens + str2Tokens) * str1Tokens) + ((str1Tokens + str2Tokens) * str2Tokens)) * ESTIMATEDTIMINGCONST
print("Starting ...")
eucledian_dist_sim("am i good good","bad bad i am",qgraml=-1)