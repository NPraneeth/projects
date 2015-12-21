package leetcode;

import java.util.ArrayList;
import java.util.List;

public class text_justification {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
//		String s = "what must be shall be.";
//		int maxWidth = 12;
//		String s = "This is an haha";
//		int maxWidth = 7;
		String s = "This is a sample experiment";
		int maxWidth = 11;
		String[] words = s.split(" ");
		
		List<String> allAns = new ArrayList<String>();
		allAns = fullJustify(words,maxWidth);
		for(int i=0;i<allAns.size();i++){
			System.out.println(allAns.get(i) + allAns.get(i).length());
		}

	}
	
	public static List<String> fullJustify(String[] words, int maxWidth) {
        List<String> allSols = new ArrayList<String>();
        for(int j=0;j<words.length;j++){
        	int nowWidth = maxWidth;
        	int len=0;
        	int noofwords = 0;
        	int noofspaces =0;
        	int remSpaces=0;
        	int morespaces=0;
        	StringBuilder sb = new StringBuilder("");
        	int i=j;
        	if(words[i].length()>nowWidth){
        		return null;
        	}
        	else{
        		len += words[i].length();
        		nowWidth -= len;
        		i++;
        	}
        	while(i<words.length && 1+words[i].length()<=nowWidth ){
        		nowWidth = nowWidth-1-words[i].length();
        		i++;
        		if(i==words.length){
        			for(int k=j;k<i;k++){
        				sb.append(words[k]+" ");
        			}
        			int remspaces = maxWidth -sb.length();
        			for(int k=0;k<remspaces;k++){
        				sb.append(" ");
        			}
        			if(sb.length()>maxWidth)allSols.add(sb.substring(0, sb.length()-1));
        			else {allSols.add(sb.toString());}
        			return allSols;
        		}
        	}
        	/*
        	while(i<words.length && 1+words[i].length()<=nowWidth ){
        		nowWidth = nowWidth-1-words[i].length();
        		i++;
        	}
        	*/
        	remSpaces = nowWidth;
        	 noofwords = i-j;
        	 if(noofwords==1){
        		 sb.append(words[j]);
        		 for(int k=0;k<nowWidth;k++){
        			 sb.append(" ");
        		 }
        		 allSols.add(sb.toString());
        		 continue;
        	 }
        	noofspaces = remSpaces/(noofwords-1);
        	morespaces = remSpaces%(noofwords-1);
        	sb.append(words[j]);j++;
        	while(j<words.length && (--noofwords)>0){
        		for(int k=0;k<noofspaces+1;k++){
        			sb.append(" ");
        		}
        		if(morespaces>0){
        			sb.append(" ");
        			morespaces--;
        		}
        		sb.append(words[j]);
        		j++;
        	}
        	j--;
        	allSols.add(sb.toString());
        }  
        return allSols;
    }

}
