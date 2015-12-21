package leetcode;

class TrieNode {
    // Initialize your data structure here.
	boolean isWord;
	char a;
	TrieNode[] children;
    public TrieNode() {
    	children = new TrieNode[26];
    	isWord = false;
    }
}

public class Trie {
    private TrieNode root;

    public Trie() {
        root = new TrieNode();
    }

    // Inserts a word into the trie.
    public void insert(String word) {
    	int i=0;
    	TrieNode newroot = root;
        while(i<word.length() && newroot!=null){
        	//System.out.println("index checking at "+Integer.toString((int)word.charAt(i)-'a'));
        	if(newroot.children[(int)word.charAt(i)-'a']==null){
        		TrieNode now = new TrieNode();
            	now.a = word.charAt(i);
            	newroot.children[(int)now.a-'a'] = now;
            	newroot = now;
        	}
        	else{
        		newroot = newroot.children[(int)word.charAt(i)-'a'];
        	}
        	i++;
        }
        newroot.isWord = true;
        return;
    }

    // Returns if the word is in the trie.
    public boolean search(String word) {
		int i =0;
		TrieNode newroot = root;
		while(i<word.length() && newroot!=null){
			if(newroot.children[(int)word.charAt(i)-'a']==null){
				return false;
			}
			else{
				newroot = newroot.children[(int)word.charAt(i)-'a'];
				//System.out.println(newroot.a);
			}
			i++;
		}
        if(newroot.isWord==true){
        	return true;
        }
        return false;
    }

    // Returns if there is any word in the trie
    // that starts with the given prefix.
    public boolean startsWith(String prefix) {
    	int i=0;
    	TrieNode newroot = root;
    	while(i<prefix.length() && newroot != null){
    		if(newroot.children[(int)prefix.charAt(i)-'a']==null){
    			return false;
    		}
    		else{
    			newroot = newroot.children[(int)prefix.charAt(i)-'a'];
    		}
    		i++;
    	}
		if(newroot==null)return false;
		return true;
    	
    }
    
    public static void main(String ...strings){
    	Trie head = new Trie();
    	head.insert("praneeth");
    	boolean isPresent = head.search("praneeth");
    	String searchOutput = isPresent?"Praneeth is found":"No such word as praneeth";
    	boolean isStartsWith = head.startsWith("pra");
    	String startWithOutput = isStartsWith?"There are string which starts with":"Nothing starts with the given prefix";
    	System.out.println(searchOutput);
    	System.out.println(startWithOutput);
    	
    }
        
}
