package leetcode;

public class longestPalindromicSubstring {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String test = "aka";
		//String test = "labakpq";
		String longestPalindromeSubstring = longestPalindrome(test);
		System.out.println(longestPalindromeSubstring);
	}
	
	 public static String longestPalindrome(String s) {
	      String s1 = s;
	      String s2 = reverse(s);
	      int max=0;
	      int maxIndex=0;
	      int[][] a = new int[s.length()+1][s.length()+1];
	      for(int i=0;i<=s.length();i++){
	    	  for(int j=0;j<=s.length();j++){
	    		  if(i==0 || j==0){
	    			  a[i][j]=0;
	    		  }
	    		  else if(s1.charAt(i-1)==s2.charAt(j-1)){
	    			  a[i][j] = a[i-1][j-1]+1;
	    		  }
	    		  else{
	    			  a[i][j]=0;
	    		  }
	    		  if(a[i][j]>=max){
	    			  max = a[i][j];
	    			  maxIndex = i;
	    		  }
	    	  }
	      }
		 return s.substring(maxIndex-max, maxIndex);
	 }

	private static String reverse(String s) {
		// TODO Auto-generated method stub
		StringBuilder sb = new StringBuilder(s);
		String newS = "";
		for(int i=sb.length()-1;i>=0;i--){
			newS += sb.charAt(i);
		}
		System.out.println(newS);
		return newS;
	}
}
