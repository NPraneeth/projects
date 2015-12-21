package leetcode;



public class WordDictionary {

    // Adds a word into the data structure.
	private TrieNode root;
	public WordDictionary(){
		this.root = new TrieNode();
	}
	public void addWord(String word){
		addWord(word,root);
	}
	
    public void addWord(String word,TrieNode root) {
        if(root==null || word==null || word.isEmpty())
        	return;
        int wordlength = word.length();
        TrieNode newroot = root.children[(int)word.charAt(0)-'a'];
        if(newroot==null){
        	TrieNode now = new TrieNode();
        	now.a = word.charAt(0);
        	System.out.println(now.a);
        	root.children[(int)word.charAt(0)-'a'] = now;
        	newroot = now;
        }
        if(wordlength==1){
        	newroot.isWord = true;
        }
        else{
        	addWord(word.substring(1),root.children[(int)word.charAt(0)-'a']);
        }
    }
        

    // Returns if the word is in the data structure. A word could
    // contain the dot character '.' to represent any one letter.
    public boolean search(String word) {
		return search(word,root);
    }
    
    public boolean search(String word,TrieNode root){
    	if(root==null || word==null )
    		return false;
    	if(word.isEmpty())return true;
    	boolean flag = false;
    	int wordlength = word.length();
    	if(word.charAt(0)=='.'){
    		for(int i=0;i<26;i++){
    			if(wordlength==1){
    				if(root.children[i]!=null && root.children[i].isWord){
    					flag = true;
    					break;
    				}
    			}
    			else{
	    			if(search(word.substring(1),root.children[i])){
	    				flag = true;
	    				break;
	    			}
    			}
    		}
    		if(flag == true)return true;
        	else{
        		return false;
        	}
    	}
    	
    	else{
	    	TrieNode newroot = root.children[(int)word.charAt(0)-'a'];
	    	if(newroot==null)return false;
	    	if(wordlength==1){
	    		if(newroot.isWord==true)return true;
	    		else return false;
	    	}
	    	else{
	        	if(search(word.substring(1),newroot))return true;
	    	}
    	}
    	return false;
    }
    
    
    public static void main(String ...strings){
    	WordDictionary dict = new WordDictionary();
    	//dict.addWord("praneeth");
    	//dict.addWord("prameela");
    	//dict.addWord("a");
    	
    	//System.out.println(dict.search(".r.ne.th"));
    	//System.out.println(dict.search("."));
    	
    	
    	dict.addWord("at");
    	System.out.println(dict.search("a"));
    	dict.addWord("and");
    	dict.addWord("an");
    	dict.addWord("add");
    	
    	System.out.println(dict.search(".at"));
    	dict.addWord("bat");
    	System.out.println(dict.search(".at"));
    	System.out.println(dict.search("an."));
    	System.out.println(dict.search("a.d."));
    	System.out.println(dict.search("b."));
    	System.out.println(dict.search("a.d"));
    	System.out.println(dict.search("."));
    	
    	
    	
    	
    	
    	
    	
    	
    }
}

// Your WordDictionary object will be instantiated and called as such:
// WordDictionary wordDictionary = new WordDictionary();
// wordDictionary.addWord("word");
// wordDictionary.search("pattern");