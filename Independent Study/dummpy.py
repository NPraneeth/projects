import math
from collections import Counter

x = math.sqrt(2*3)
print(x)

y = float(math.sqrt(2*3))
print(y)

a = Counter({'good': 2, 'i': 1, 'am': 1})
b = Counter({'bad': 2, 'i': 1, 'am': 1})
total = Counter({'i': 2, 'bad': 2, 'good': 2, 'am': 2})
totalDistance=0;
for key in total:
	print("in a : " + str(a[key]))
	print("in b : " + str(b[key]))
	print("in total : " + str(total[key]))
	totalDistance = totalDistance + (a[key]-b[key])*(a[key]-b[key])
print totalDistance
