package leetcode;

import java.util.Arrays;
import java.util.LinkedList;

class TreeNode {
    int val;
    TreeNode left;
    TreeNode right;
    TreeNode(int x) { val = x; left = null; right = null;}
}

public class serialize_deserialize {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		TreeNode a = new TreeNode(1);
		TreeNode b = new TreeNode(2);
		TreeNode c = new TreeNode(3);
		a.left = b;
		a.right = c;
		TreeNode d = new TreeNode(4);
		TreeNode e = new TreeNode(5);
		TreeNode f = new TreeNode(6);
		b.left = d;
		c.left = e;
		e.right = f;
		String serialized_str = new serialize_deserialize().serialize(a);
		System.out.println("Serialized String is " + serialized_str);
		TreeNode x = new serialize_deserialize().deserialize(serialized_str);
		String newseri_str = new serialize_deserialize().serialize(x);
		System.out.println("New Serialized String is " + newseri_str);
		
	}
	
	 // Encodes a tree to a single string.
    public String serialize(TreeNode root) {
		LinkedList<TreeNode> queue = new LinkedList<TreeNode>();
		queue.addLast(root);
		StringBuilder ans =new StringBuilder("");
		while(!queue.isEmpty()){
			TreeNode par = queue.removeFirst();
			if(par!=null){
				ans.append(Integer.toString(par.val) + ",");
				queue.addLast(par.left);
				queue.addLast(par.right);
			}
			else{
				ans.append("null,") ;
			}
		}
		return ans.substring(0,ans.length()-1);
    }

    // Decodes your encoded data to tree.
    public TreeNode deserialize(String data) {

        if(data==null || data=="") return null;
		String[] node = data.split(",");
		if(node.length==1)return new TreeNode(Integer.parseInt(node[0]));
		
		LinkedList<TreeNode> nodes = new LinkedList<TreeNode>();
		TreeNode root = new TreeNode(Integer.parseInt(node[0]));
		nodes.addLast(root);
		int i=1;
		int len = node.length;
		while(i<len){
			String val1 = node[i];
			String val2 = node[i+1];
			TreeNode t1 = (val1.equals("null"))?null:new TreeNode(Integer.parseInt(val1));
			TreeNode t2 = (val2.equals("null"))?null:new TreeNode(Integer.parseInt(val2));
			TreeNode p = nodes.removeFirst();
			if(p!=null){
				p.left = t1;
				p.right = t2;
			}
			if(t1!=null)nodes.addLast(t1);
			if(t2!=null)nodes.addLast(t2);
			i=i+2;
		}
		return root;
    
    	/*
    	if(data==null || data=="") return null;
		String[] node = data.split(",");
		if(node.length==1)return new TreeNode(Integer.parseInt(node[0]));
		
		LinkedList<String> elems= new LinkedList<String>(Arrays.asList(node));
		LinkedList<TreeNode> nodes = new LinkedList<TreeNode>();
		TreeNode root = new TreeNode(Integer.parseInt(elems.removeFirst()));
		nodes.addLast(root);
		while(!elems.isEmpty()){
			String val1 = elems.removeFirst();
			String val2 = elems.removeFirst();
			TreeNode t1 = (val1.equals("null"))?null:new TreeNode(Integer.parseInt(val1));
			TreeNode t2 = (val2.equals("null"))?null:new TreeNode(Integer.parseInt(val2));
			TreeNode p = nodes.removeFirst();
			if(p!=null){
				p.left = t1;
				p.right = t2;
			}
			if(t1!=null)nodes.addLast(t1);
			if(t2!=null)nodes.addLast(t2);
		}
		return root;
		*/
    }

}
