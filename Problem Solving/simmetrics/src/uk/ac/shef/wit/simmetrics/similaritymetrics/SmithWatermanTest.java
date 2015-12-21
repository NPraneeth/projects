/**
 * SimMetrics - SimMetrics is a java library of Similarity or Distance
 * Metrics, e.g. Levenshtein Distance, that provide float based similarity
 * measures between String Data. All metrics return consistant measures
 * rather than unbounded similarity scores.
 *
 * Copyright (C) 2005 Sam Chapman - Open Source Release v1.1
 *
 * Please Feel free to contact me about this library, I would appreciate
 * knowing quickly what you wish to use it for and any criticisms/comments
 * upon the SimMetric library.
 *
 * email:       s.chapman@dcs.shef.ac.uk
 * www:         http://www.dcs.shef.ac.uk/~sam/
 * www:         http://www.dcs.shef.ac.uk/~sam/stringmetrics.html
 *
 * address:     Sam Chapman,
 *              Department of Computer Science,
 *              University of Sheffield,
 *              Sheffield,
 *              S. Yorks,
 *              S1 4DP
 *              United Kingdom,
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */

package uk.ac.shef.wit.simmetrics.similaritymetrics;

import junit.framework.TestCase;

/**
 * Performs a unit test upon the SmithWaterman string metric.
 *
 * @author Sam Chapman <a href="http://www.dcs.shef.ac.uk/~sam/">Website</a>, <a href="mailto:sam@dcs.shef.ac.uk">Email</a>.
 */
public class SmithWatermanTest extends TestCase {

    //private method to hold metric test cases
    private AbstractStringMetric metric;

    /**
     * Sets up the test fixture.
     *
     * Called before every test case method.
     */
    protected void setUp() {
        metric = new SmithWaterman();
    }

    /**
     * Tears down the test fixture.
     *
     * Called after every test case method.
     */
    protected void tearDown() {
        // release objects under test here, if necessary
    }

    /**
     * Tests emptying the cart.
     */
    public void testGetSimilarity() {

//        float result = metric.getSimilarity("Test String1", "Test String2");
//
//        assertEquals(0.9166667f, result);
//        System.out.println("1:"+metric.getUnNormalisedSimilarity("GCATGCU","GATTACA"));
        System.out.println("2:"+metric.getUnNormalisedSimilarity("University of Wisconsin Madison","UW Madison"));
//        System.out.println("3:"+metric.getUnNormalisedSimilarity("Praneeth","Prameela"));
//        System.out.println("4:"+metric.getUnNormalisedSimilarity("Test String1", "Test String2"));
//        System.out.println("5:"+metric.getUnNormalisedSimilarity("", ""));
//        System.out.println("Similarity Now : ");
//        System.out.println("1:"+metric.getSimilarity("GCATGCU","GATTACA"));
        System.out.println("2 haha :"+metric.getSimilarity("University of Wisconsin Madison","UW Madison"));
//        System.out.println("3:"+metric.getSimilarity("Praneeth","Prameela"));
//        System.out.println("4:"+metric.getSimilarity("Test String1", "Test String2"));
//        System.out.println("5:"+metric.getSimilarity("", ""));
//        System.out.println("6:"+metric.getSimilarity("Praneeth", null));
//        System.out.println("7:"+metric.getSimilarity(null, "Praneeth"));
//        System.out.println("8:"+metric.getSimilarity(null, null));
        System.out.println("Sim between Test nd Test is "+metric.getSimilarity("Test", "Test"));
        System.out.println("Sim between String1 and String2 is "+metric.getSimilarity("String1", "String2"));
    }
}

