import unittest
from distance import sim_cosine
from distance import dist_cosine

class CosineSimiliarityTest(unittest.TestCase):
	def test_sim_cosine(self):
		self.assertEqual(sim_cosine('',''),0)
		self.assertEqual(sim_cosine('',''),1)

	def test_dist_cosine(self):
		self.assertEqual(dist_cosine('',''),0)


if __name__=='__main__':
	unittest.main()