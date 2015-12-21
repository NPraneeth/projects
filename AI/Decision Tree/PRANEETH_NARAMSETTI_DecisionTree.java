import java.util.LinkedList;

import processing.core.*;
import processing.data.XML;

public class PRANEETH_NARAMSETTI_DecisionTree extends DrawableTree
{
	public static XML trainData;
	public static String[] attributes = {"vote01","vote02","vote03","vote04","vote05","vote06","vote07","vote08","vote09","vote10","vote11","vote12","vote13","vote14","vote15","vote16"};
	public PRANEETH_NARAMSETTI_DecisionTree(PApplet p) { super(p);}
		
	// This method loads the examples from the provided filename, and
	// then builds a decision tree (stored in the inherited field: tree).
	// Each of the nodes in this resulting tree will be named after
	// either an attribute to split on (vote01, vote02, etc), or a party
	// classification (DEMOCRAT, REPUBLICAN, or possibly TIE).
	public void learnFromTrainingData(String filename)
	{
		// NOTE: Set the inherited field dirtyTree to true after building the
		// decision tree and storing it in the inherited field tree.  This will
		// trigger the DrawableTree's graphical rendering of the tree.
		this.dirtyTree =true;
		XML dataset = p.loadXML(filename);
		dataset = removeEmtptyNodes(dataset);
		if(this.tree==null)tree = new XML("dectree");
		recursiveBuildTree(dataset,this.tree);
		return;
	}
			
	// This method recursively builds a decision tree based on
	// the set of examples that are children of dataset.
	public void recursiveBuildTree(XML dataset, XML tree)
	{
		// NOTE: You MUST add YEA branches to your decision nodes before
		// adding NAY branches.  This will result in YEA branches being
		// child[0], which will be drawn to the left of any NAY branches.
		// The grading tests assume that you are following this convention.
		
		if(dataset==null)return;
		String toSplit = this.chooseSplitAttribute(dataset);
		if(toSplit==null){
			tree.setName(plurality(dataset));
			return;
		}
		XML datasetYnode = new XML(toSplit+"Y");
		XML datasetNnode = new XML(toSplit+"N");
		XML datasetY = new XML("dataset");
		XML datasetN = new XML("dataset");
		XML[] childrenDataset = dataset.getChildren();
		for(int i=0;i<childrenDataset.length;i++){
			if(childrenDataset[i].getString(toSplit).equals("YEA")){
				datasetY.addChild(childrenDataset[i]);
			}
			if(childrenDataset[i].getString(toSplit).equals("NAY")){
				datasetN.addChild(childrenDataset[i]);
			}
		}
	    tree.setName(toSplit);
		this.recursiveBuildTree(datasetY, datasetYnode);
		this.recursiveBuildTree(datasetN, datasetNnode);
		tree.addChild(datasetYnode);
		tree.addChild(datasetNnode);
	}

	// This method calculates and returns the mode (most common value) among
	// the party attributes of the children examples under dataset.  If there
	// happens to be an exact tie, this method returns "TIE".
	public String plurality(XML dataset)
	{
		int democrats=0;
		int republicans=0;
		XML[] children = dataset.getChildren();
		for(int i=0;i<children.length;i++){
			if(children[i].getString("party").equals("DEMOCRAT")){
				democrats++;
			}
			else if(children[i].getString("party").equals("REPUBLICAN")){
				republicans++;
			}
		}
		if(democrats>republicans){
			return "DEMOCRAT";
		}
		else if (democrats<republicans){
			return "REPUBLICAN";
		}
		else return "TIE";
	}

	// This method calculates and returns the name of the attribute that results
	// in the lowest entropy, after splitting all children examples according
	// to their value for this attribute into two separate groups: YEA vs. NAY.	
	public String chooseSplitAttribute(XML dataset)
	{
		if(dataset.getChildCount()==0)return null;
		double entropy_of_given_dataset = calculateEntropy(dataset);
		if(entropy_of_given_dataset == 0.0)return null;
		double maxgain=0.0;
		String minAttribute = "";
		double information_gain=0.0;
		for(int i=0;i<16;i++){
			double entropy_after_split = calculatePostSplitEntropy(attributes[i],dataset);
			 information_gain = entropy_of_given_dataset - entropy_after_split;
			if(information_gain>=maxgain){
				maxgain = information_gain;
				minAttribute = attributes[i];
			}
		}
		return minAttribute;
	}
		
	// This method calculates and returns the entropy that results after 
	// splitting the children examples of dataset into two groups based
	// on their YEA vs. NAY value for the specified attribute.
	public double calculatePostSplitEntropy(String attribute, XML dataset)
	{		
		XML datasetY = new XML("dataset");
		XML datasetN = new XML("dataset");
		XML[] childrenDataset = dataset.getChildren();
		if(childrenDataset.length==0)return 1.0;
		for(int i=0;i<childrenDataset.length;i++){
			if(childrenDataset[i].getString(attribute).equals("YEA")){
				datasetY.addChild(childrenDataset[i]);
			}
			if(childrenDataset[i].getString(attribute).equals("NAY")){
				datasetN.addChild(childrenDataset[i]);
			}
		}
		double entropyY = 0.0;
		double fractionY = 0.0;
		if(datasetY.getChildCount()>0){
		 entropyY = calculateEntropy(datasetY);
		 fractionY = (double)datasetY.getChildCount()/(double)dataset.getChildCount();
		}
		double entropyN = 0.0;
		double fractionN = 0.0;
		if(datasetN.getChildCount()>0){
		 entropyN = calculateEntropy(datasetN);
		 fractionN = (double)datasetN.getChildCount()/(double)dataset.getChildCount();
		}
		double entropypostsplit = fractionY * entropyY + fractionN * entropyN;
		return entropypostsplit;
	}
	
	// This method calculates and returns the entropy for the children examples
	// of a single dataset node with respect to which party they belong to.
	public double calculateEntropy(XML dataset)
	{
		XML[] childrenExample = dataset.getChildren();
		int noOfDemo=0,noOfRep=0;
		for(int i=0;i<childrenExample.length;i++){
			if(childrenExample[i].getString("party").equals("DEMOCRAT")){
				noOfDemo++;
			}
			else if(childrenExample[i].getString("party").equals("REPUBLICAN")){
				noOfRep++;
			}
			else{
				System.out.println("XML Data contains some party other than DEMOCRAT or REPUBLICAN.");
			}
		}
		double total = (double)noOfDemo+(double)noOfRep;
		double p = (double)noOfDemo/(double)total;
		double entropy = B(p);
		return entropy;
	}

	// This method calculates and returns the entropy of a Boolean random 
	// variable that is true with probability q (as on page 704 of the text).
	// Don't forget to use the limit, when q makes this formula unstable.
	public static double B(double q)
	{
		if(q==0.0 || q==1.0)return 0.0;
		double entropy = -1 * ((q*Math.log10(q)/Math.log((double)2) + (1-q)*Math.log10(1-q)/Math.log((double)2)));
		return entropy;
	}

	// This method loads and runs an entire file of examples against the 
	// decision tree, and returns the percentage of those examples that this
	// decision tree correctly predicts.
	public double runTests(String filename)
	{
		int correct=0;
		XML testDataLocal = p.loadXML(filename);
		testDataLocal = removeEmtptyNodes(testDataLocal);
		XML[] testDataExamples = testDataLocal.getChildren();
		for(int i=0;i<testDataExamples.length;i++){
			if(testDataExamples[i].getString("party").equals(predict(testDataExamples[i],this.tree))){
				correct++;
			}
		}
		return 100 * ((double)correct/(double)testDataExamples.length);
	}
	
	// This method runs a single example through the decision tree, and then 
	// returns the party that this tree predicts the example to belonging to.
	// If this example contains a party attribute, it should be ignored here.	
	public String predict(XML example, XML decisionTree)
	{
		int noofchildren=0;
		noofchildren = decisionTree.getChildCount();
		if(noofchildren==0){
			return decisionTree.getName();
		}
		if(example.getString(decisionTree.getName()).equals("YEA"))
		{
			return predict(example,decisionTree.getChild(0));
		}
		if(example.getString(decisionTree.getName()).equals("NAY"))
		{
			return predict(example,decisionTree.getChild(1));
		}
		return "";
	}
	
	public XML removeEmtptyNodes(XML trainData){
		if(trainData==null)return null;
		LinkedList<XML> ll = new LinkedList<XML>();
		ll.push(trainData);
		while(!ll.isEmpty()){
			XML now = ll.pollFirst();
			if(now!=null){
				XML[] children = now.getChildren();
				int childcount = now.getChildCount();
				for(int k=0;k < childcount;k++){
					if(children[k].getName().equals("#text")){
						now.removeChild(children[k]);
					}
					else{
						ll.addLast(children[k]);
					}
				}
			}
		}
		return trainData;
	}
}
