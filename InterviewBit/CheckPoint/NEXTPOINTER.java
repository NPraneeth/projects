

class TreeLinkNode {
	int val;
	TreeLinkNode left;
	TreeLinkNode right;
	TreeLinkNode next;
	TreeLinkNode(int x){
		this.val = x;
	}
}

public class NEXTPOINTER {
    public static void connect(TreeLinkNode root) {
        if(root == null){
            return;
        }
     if(root.left != null){
     	root.left.next = root.right;
     }
     if(root.next != null && root.next.left != null){
     	root.right.next = root.next.left;
     }
     
     if(root.left != null) {
     	connect(root.left);
     	connect(root.right);
     }
 }
    
    public static void main(String ...args){
    	TreeLinkNode r = new TreeLinkNode(1);
    	TreeLinkNode rl = new TreeLinkNode(2);
    	TreeLinkNode rr = new TreeLinkNode(3);
    	r.left = rl;
    	r.right = rr;
    	connect(r);
    	System.out.println(r.next + " " +rl.next+ " " + rr.next);
    	return;
    	
    }
}

