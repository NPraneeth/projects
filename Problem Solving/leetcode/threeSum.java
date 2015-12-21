package leetcode;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.List;

public class threeSum {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] nums = {-1,0,1,2,-1};
		List<List<Integer>> ans = threeSum(nums);
		for(int i=0;i<ans.size();i++){
			List<Integer> eachsol = ans.get(i);
			for(int j=0;j<eachsol.size();j++){
				System.out.print(eachsol.get(j) + " ");
			}
			System.out.println();
		}
	}

	public static List<List<Integer>> threeSum(int[] nums) {
		List<List<Integer>> sols = new ArrayList<List<Integer>>();
		Arrays.sort(nums);
		for(int k=0;k<nums.length-2;k++){
		    if(k>0 && nums[k]==nums[k-1])continue; // This is to avoid duplicates being counted.
			int i=k+1;
			int j=nums.length-1;
			while(i<j){
				if(nums[i]+nums[j] < (-1)*nums[k]){
					i++;
				}
				else if (nums[i]+nums[j] > (-1)*nums[k]){
					j--;
				}
				else{
					List<Integer> ans = new ArrayList<Integer>();
					ans.add(nums[k]);ans.add(nums[i]);ans.add(nums[j]);
					if(!sols.contains(ans)) sols.add(ans);
					i++;
				}
			}
		}
		return sols;
        
    }
	
}
