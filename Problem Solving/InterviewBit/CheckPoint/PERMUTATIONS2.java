//accepted

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.HashSet;
import java.util.Set;

public class PERMUTATIONS2 {
	 //public static ArrayList<ArrayList<Integer>> solution = new ArrayList<ArrayList<Integer>>();
	
		public static ArrayList<ArrayList<Integer>> permute(ArrayList<Integer> a) {
			 ArrayList<ArrayList<Integer>> localsolution = new ArrayList<ArrayList<Integer>>();
			localsolution = permutations(a,0,a.size(),localsolution);
			System.out.println(localsolution);
			return localsolution;
		}
		
		public static ArrayList<ArrayList<Integer>> permutations(ArrayList<Integer> a, int size, int length, ArrayList<ArrayList<Integer>> solution){
			if(size == length-1){
				solution.add((ArrayList<Integer>)a.clone());
			}
			else{
				Set<Integer> s = new HashSet<Integer>();
				for(int i=size; i< length;i++){
					if(!s.contains(a.get(i))){
						s.add(a.get(i));
						Collections.swap(a, size, i);
						solution = permutations(a,size+1,length,solution);
						Collections.swap(a,i,size);
					}
				}
			}
			return solution;
		}
		
		public static void main(String[] args) {
			// TODO Auto-generated method stub
			ArrayList<Integer> input = new ArrayList<Integer>(Arrays.asList(1,1,2,2));
			permute(input);	
		}
}
