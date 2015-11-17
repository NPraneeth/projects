
from collections import Counter
import unicodedata
from qgram import QGrams
import math
try:
    import lzma
except ImportError:  # pragma: no cover
    # If the system lacks the lzma library, that's fine, but lzma comrpession
    # similarity won't be supported.
    pass

def sim_cosine(src, tar, qval=2):
    """
    
	    cosine similarity (Ochiai coefficient)
	    For two sets X and Y, the cosine similarity (Ochiai coefficient) is:
	    :math:`sim_{cosine}(X, Y) = \\frac{|X \\cap Y|}{\\sqrt{|X| \\cdot |Y|}}`
	    :param str src, tar: two strings to be compared (or QGrams/Counter objects)
	    :param int qval: the length of each q-gram; 0 or None for non-q-gram
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
    if src == tar:
        return 1.0
    if not src or not tar:
        return 0.0

    if isinstance(src, Counter) and isinstance(tar, Counter):
        q_src = src
        q_tar = tar
    elif qval and qval > 0:
        q_src = QGrams(src, qval)
        print q_src
        q_tar = QGrams(tar, qval)
        print q_tar
    else:
        q_src = Counter(src.strip().split())
        q_tar = Counter(tar.strip().split())
    q_src_mag = sum(q_src.values())
    q_tar_mag = sum(q_tar.values())
    q_intersection_mag = sum((q_src & q_tar).values())

    return q_intersection_mag / math.sqrt(q_src_mag * q_tar_mag)


def dist_cosine(src, tar, qval=2):
    return 1 - sim_cosine(src, tar, qval)

print sim_cosine('','')
#sim_cosine("Praneeth","Swarupa",qval=3)
