package leetcode;

	
	public class Solution {
	    public int myAtoi(String str) {
	    	long ans =0;
	        str = str.trim();
	        if(str.length()==0)return 0;
	    	Character sign = str.charAt(0);
	    	if(sign.equals('-') || sign.equals('+')){
	    		str = str.substring(1);
	    	}
	        for(int i=1;i<=str.length();i++){
	            int digit = str.charAt(i-1)-'0';
	            if(digit<0 || digit>9){
	            	ans =  (ans)/(long)Math.pow(10, str.length()-i+1);
	            	break;
	            }
	            ans += digit*Math.pow(10, str.length()-i);
	        }
	        
	        if(sign.equals('-')){
	    		ans = (-1)*ans;
	    	}
	        if(ans>Integer.MAX_VALUE)return Integer.MAX_VALUE;
	        else if( ans < Integer.MIN_VALUE) return Integer.MIN_VALUE;
	        else return (int) ans;
	    }
	    
	    public static void main(String ...strings ){
	    	String str = "  -0012a42";
	    	
	    	int strtoint = new Solution().myAtoi(str);
	    	System.out.println(strtoint);
	    }
	}
	 
