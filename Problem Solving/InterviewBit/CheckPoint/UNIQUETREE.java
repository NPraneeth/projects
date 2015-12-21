import java.util.ArrayList;

class TreeNode {
     int val;
     TreeNode left;
     TreeNode right;
     TreeNode(int x) { val = x; }
 }

public class UNIQUETREE {

	public static ArrayList<TreeNode> generateTrees(int a) {
		ArrayList<TreeNode> generatedTrees = new ArrayList<TreeNode>();
		generatedTrees = generateMyTrees(1,a);
		return generatedTrees;
	}
	
	public static ArrayList<TreeNode> generateMyTrees(int start, int end){
		ArrayList<TreeNode> allTrees = new ArrayList<TreeNode>();
		if(start<=end){
			for(int i=start;i<=end;i++){
				ArrayList<TreeNode> leftTrees = generateMyTrees(start,i-1);
				ArrayList<TreeNode> rightTrees = generateMyTrees(i+1,end);
				for(TreeNode eachLeftTree : leftTrees){
					for( TreeNode eachRightTree : rightTrees){
						TreeNode root = new TreeNode(i);
						root.right = eachRightTree;
						root.left = eachLeftTree;
						allTrees.add(root);
					}
				}
			}
		}
		
		else{
			allTrees.add(null);
		}
		return allTrees;
	}
		
	public static void printTree(TreeNode root){
		if(root==null) return;
		if(root.left != null) printTree(root.left);
		if(root.right!=null)  printTree(root.right);
		System.out.print(" "+root.val);
		return;
	}
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int n = 3;
		ArrayList<TreeNode> allTrees = generateTrees(n);
		for(int i=0;i<allTrees.size();i++){
			printTree(allTrees.get(i));
			System.out.println();
		}
	}

}
