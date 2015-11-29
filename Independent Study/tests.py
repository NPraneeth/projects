import unittest
from distnace import sim_cosine
from distnace import dist_cosine
from distnace import dice_sim
from distnace import dice_dist
from distnace import eucledian_dist_sim
from distnace import matching_coefficient
from distnace import qgram_distance
from distnace import block_distance

class SimiliarityTests(unittest.TestCase):
	def test_sim_cosine(self):
		self.assertEqual(sim_cosine('',''),1)
		self.assertEqual(sim_cosine('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(dist_cosine('Test String1','Test String2',qgraml=None),float(0.5))
		#self.assertEqual(sim_cosine('Test String1','Test String2',qgraml=3),float())

	def test_dice_sim(self):
		self.assertEqual(dice_sim('',''),1)
		self.assertEqual(dice_sim('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(dice_dist('Test String1','Test String2',qgraml=None),float(0.5))

	def test_eucledian_dist_sim(self):
		self.assertEqual(eucledian_dist_sim('',''),1)
		self.assertEqual(eucledian_dist_sim('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(eucledian_dist_sim('Test String1','Test String2',qgraml=3),float(0.8762821));

	def test_matching_coefficient(self):
		self.assertEqual(matching_coefficient('',''),1)
		self.assertEqual(matching_coefficient('Test String1','Test String2',qgraml=None),float(0.5))

	def test_qgram_distance(self):
		self.assertEqual(qgram_distance('',''),1)
		self.assertEqual(qgram_distance('Test String1','Test String2',qgraml=3),float(0.7857142857142857))

	def test_block_distance(self):
		self.assertEqual(block_distance('',''),1)
		self.assertEqual(block_distance('Test String1','Test String2'),float(0.5))


if __name__=='__main__':
	unittest.main()