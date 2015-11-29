import unittest
from Distance import sim_cosine
from Distance import dist_cosine
from Distance import dice_sim
from Distance import dice_dist
from Distance import eucledian_dist_sim
from Distance import matching_coefficient
from Distance import qgram_distance
from Distance import block_distance
from Distance import chapman_length_deviation
from Distance import chapman_mean_length
from Distance import calculate_soundex
from Distance import monge_elkan_sim
from Distance import needleman_wunch_score
from Distance import needleman_wunch_sim
from Distance import smith_waterman_score
from Distance import smith_waterman_sim
from Distance import smith_waterman


class SimiliarityTests(unittest.TestCase):
	def test_sim_cosine(self):
		self.assertEqual(sim_cosine(None,"String2"),float(0))
		self.assertEqual(sim_cosine("String1",None),float(0))
		self.assertEqual(sim_cosine('',''),float(1))
		self.assertEqual(sim_cosine('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(dist_cosine('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(sim_cosine('Test String1','Test String2',qgraml=3),float(0.7857142857142857))
		self.assertEqual(dist_cosine('Test String1','Test String2',qgraml=3),float(0.2142857142857143))
		self.assertEqual(sim_cosine('Praneeth','Prameela',qgraml=3),float(0.3))
		self.assertEqual(sim_cosine('Praneeth','Prameela',qgraml=None),float(0))
		self.assertEqual(sim_cosine('I am a good boy','am I a good boy',qgraml=None),float(1))
		self.assertEqual(sim_cosine('University of Wisconsin Madison','UW Madison'),float(0.35355339059327373))

	def test_dice_sim(self):
		self.assertEqual(dice_sim(None,"String2"),float(0))
		self.assertEqual(dice_sim("String1",None),float(0))
		self.assertEqual(dice_sim('',''),float(1))
		self.assertEqual(dice_sim('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(dice_dist('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(dice_sim('Test String1','Test String2',qgraml=3),float(0.7857142857142857))
		self.assertEqual(dice_dist('Test String1','Test String2',qgraml=3),float(0.2142857142857143))
		self.assertEqual(dice_sim('Praneeth','Prameela',qgraml=3),float(0.3))
		self.assertEqual(dice_dist('Praneeth','Prameela',qgraml=3),float(0.7))
		self.assertEqual(dice_sim('I am a good boy','am I a good boy',qgraml=None),float(1))

	def test_eucledian_dist_sim(self):
		self.assertEqual(eucledian_dist_sim(None,"String2"),float(0))
		self.assertEqual(eucledian_dist_sim("String1",None),float(0))
		self.assertEqual(eucledian_dist_sim('',''),float(1))
		self.assertEqual(eucledian_dist_sim('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(eucledian_dist_sim('Test String1','Test String2',qgraml=3),float(0.8762820851736516))
		self.assertEqual(eucledian_dist_sim('Praneeth','Proof',qgraml=3),float(0.704621730407176))
		self.assertEqual(eucledian_dist_sim('I am a good boy','am I a good boy',qgraml=None),float(1))

	def test_qgram_distance(self):
		self.assertEqual(qgram_distance(None,"String2"),float(0))
		self.assertEqual(qgram_distance("String1",None),float(0))
		self.assertEqual(qgram_distance('',''),float(1))
		self.assertEqual(qgram_distance('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(qgram_distance('Test String1','Test String2',qgraml=3),float(0.7857142857142857))
		self.assertEqual(qgram_distance('Praneeth','Proof',qgraml=3),float(0.23529411764705882))
		self.assertEqual(qgram_distance('I am a good boy','am I a good boy',qgraml=None),float(1))
	'''
	def test_matching_coefficient(self):
		self.assertEqual(matching_coefficient('',''),1)
		self.assertEqual(matching_coefficient('Test String1','Test String2',qgraml=None),float(0.5))
	'''

	def test_block_distance(self):
		self.assertEqual(block_distance(None,"String2"),float(0))
		self.assertEqual(block_distance("String1",None),float(0))
		self.assertEqual(block_distance('',''),float(1))
		self.assertEqual(block_distance('Test String1','Test String2',qgraml=None),float(0.5))
		self.assertEqual(block_distance('Test String1','Test String2',qgraml=3),float(0.7857142857142857))
		self.assertEqual(block_distance('Praneeth','Proof',qgraml=3),float(0.23529411764705882))
		self.assertEqual(block_distance('I am a good boy','am I a good boy',qgraml=None),float(1))

	def test_chapman_length_deviation(self):
		self.assertEqual(chapman_length_deviation('Test String1','Test String2'),float(1))
		self.assertEqual(chapman_length_deviation('University of Wisconsin - Madison','UW - Madison'),float(0.36363636363636365))
		self.assertEqual(chapman_length_deviation('Praneeth','Swarupa'),float(0.875))
		self.assertEqual(chapman_length_deviation(None,None),float(1))
		self.assertEqual(chapman_length_deviation('',''),float(1))
		self.assertEqual(chapman_length_deviation('Praneeth','Praneeth'),float(1))

	def test_chapman_mean_length(self):
		self.assertEqual(chapman_mean_length('Test String1','Test String2'),float(0.1786130595840002))
		self.assertEqual(chapman_mean_length('University of Wisconsin - Madison','UW - Madison'),float(0.3142503899999999))
		self.assertEqual(chapman_mean_length('Praneeth','Swarupa'),float(0.11470719000000007))
		#self.assertEqual(chapman_mean_length(None,None),float(1))
		#self.assertEqual(chapman_mean_length('',''),float(1))
		self.assertEqual(chapman_mean_length('Praneeth','Praneeth'),float(0.12198602342400011))

	def test_calculate_soundex(self):
		self.assertEqual(calculate_soundex('Test String1',6),'T-2323')
		self.assertEqual(calculate_soundex('Praneeth Naramsetti',6),'P-6535')
		self.assertEqual(calculate_soundex('University of Wisconsin Madison',6),'U-5162')
		self.assertEqual(calculate_soundex('University of Wisc',6),'U-5162')
		self.assertEqual(calculate_soundex('Hi',6),'H-0000')
		self.assertEqual(calculate_soundex('Hen',6),'H-5000')
		self.assertEqual(calculate_soundex('',6),'')
		self.assertEqual(calculate_soundex(None,6),'')

	def test_monge_elkan(self):
		self.assertEqual(monge_elkan_sim('Test String1','Test String2',qgraml=None,func=sim_cosine),float(0.5))
		self.assertEqual(monge_elkan_sim('Praneeth','PRANEETH',qgraml=None,func=sim_cosine),float(0))
		self.assertEqual(monge_elkan_sim('University of Wisconsin Madison','UW Madison',qgraml=None,func=sim_cosine),float(0.25))
		self.assertEqual(monge_elkan_sim('I am a good boy','am I a good boy',qgraml=None,func=sim_cosine),float(1))
		self.assertEqual(monge_elkan_sim('Praneeth','Prameela',qgraml=3,func=sim_cosine),float(0.527360679774998))
		self.assertEqual(monge_elkan_sim('','',qgraml=None,func=sim_cosine),float(1))
		self.assertEqual(monge_elkan_sim(None,None,qgraml=None,func=sim_cosine),float(1))
		self.assertEqual(monge_elkan_sim('Test String1',None,qgraml=None,func=sim_cosine),float(0))
		self.assertEqual(monge_elkan_sim(None,'Test String2',qgraml=None,func=sim_cosine),float(0))

	def test_needleman_wunch_score(self):
		self.assertEqual(needleman_wunch_score('GCATGCU','GATTACA'),float(4))
		self.assertEqual(needleman_wunch_score('University of Wisconsin Madison','UW Madison'),float(23))
		self.assertEqual(needleman_wunch_score('Praneeth','Prameela'),float(3))
		self.assertEqual(needleman_wunch_score('Test String1','Test String2'),float(1))
		self.assertEqual(needleman_wunch_score('',''),float(0))

	def test_needleman_wunch_sim(self):
		self.assertEqual(needleman_wunch_sim('Test String1','Test String2'),float(0.95833333333333337))
		self.assertEqual(needleman_wunch_sim('GCATGCU','GATTACA'),float(0.7142857142857143))
		self.assertEqual(needleman_wunch_sim('University of Wisconsin Madison','UW Madison'),float(0.62903225806451613))
		self.assertEqual(needleman_wunch_sim('Praneeth','Prameela'),float(0.8125))
		self.assertEqual(needleman_wunch_sim('',''),float(1))
		self.assertEqual(needleman_wunch_sim('Praneeth',None),float(0))
		self.assertEqual(needleman_wunch_sim(None,'Prameela'),float(0))
		self.assertEqual(needleman_wunch_sim(None,None),float(0))

	def test_smith_waterman_score(self):
		self.assertEqual(smith_waterman_score('GCATGCU','GATTACA'),float(2.5))
		self.assertEqual(smith_waterman_score('University of Wisconsin Madison','UW Madison'),float(8))
		self.assertEqual(smith_waterman_score('Praneeth','Prameela'),float(4))
		self.assertEqual(smith_waterman_score('Test String1','Test String2'),float(11))
		self.assertEqual(smith_waterman_score('',''),float(0))

	def test_smith_waterman_sim(self):
		self.assertEqual(smith_waterman_sim('Test String1','Test String2'),float(0.91666666666666663))
		self.assertEqual(smith_waterman_sim('GCATGCU','GATTACA'),float(0.35714285714285715))
		self.assertEqual(smith_waterman_sim('University of Wisconsin Madison','UW Madison'),float(0.80000000000000004))
		self.assertEqual(smith_waterman_sim('Praneeth','Prameela'),float(0.5))
		self.assertEqual(smith_waterman_sim('',''),float(1))
		self.assertEqual(smith_waterman_sim('Praneeth',None),float(0))
		self.assertEqual(smith_waterman_sim(None,'Prameela'),float(0))
		self.assertEqual(smith_waterman_sim(None,None),float(0))
	'''
	def test_smith_waterman(self):
		self.assertEqual(smith_waterman('GCATGCU','GATTACA'),float(2.5))
		self.assertEqual(smith_waterman('University of Wisconsin Madison','UW Madison'),float(8))
		self.assertEqual(smith_waterman('Praneeth','Prameela'),float(4))
		self.assertEqual(smith_waterman('Test String1','Test String2'),float(11))
		self.assertEqual(smith_waterman('',''),float(0))
	'''




















if __name__=='__main__':
	unittest.main()