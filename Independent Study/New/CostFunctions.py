




class simCost_plus0_plus1:
	@staticmethod
	def getCost(src,srcIndex,dest,destIndex):
		if src[srcIndex]==dest[destIndex]:
			return float(0)
		else:
			return float(1)
	@staticmethod
	def getMaxCost():
		return float(1)
	@staticmethod
	def getMinCost():
		return float(0)

class simCost_plus1_minus2:
	@staticmethod
	def getCost(src,srcIndex,dest,destIndex):
		if src[srcIndex]==dest[destIndex]:
			return float(1)
		else:
			return float(-2)

	@staticmethod
	def getMaxCost():
		return float(1)

	@staticmethod
	def getMinCost():
		return float(-2)

