package leetcode;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class fourSum {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] nums = {1,0,-1,0,-2,2};
		List<List<Integer>> ans = foursum(nums,0);
		for(int i=0;i<ans.size();i++){
			List<Integer> eachsol = ans.get(i);
			for(int j=0;j<eachsol.size();j++){
				System.out.print(eachsol.get(j) + " ");
			}
			System.out.println();
		}
	}
	
	public static List<List<Integer>> foursum(int[] nums,int target) {
		List<List<Integer>> sols = new ArrayList<List<Integer>>();
		Arrays.sort(nums);
		int diff= Integer.MAX_VALUE;
		int sum = 0;
		for(int p=0;p<nums.length-3;p++){
			if(p>0 && nums[p]==nums[p-1])continue;
			for(int k=p+1;k<nums.length-2;k++){
			    if(k>p+1 && nums[k]==nums[k-1])continue; // This is to avoid duplicates being counted.
				int i=k+1;
				int j=nums.length-1;
				while(i<j){
					
					if(nums[i]+nums[j]+nums[k]+nums[p] < target){
						i++;
					}
					else if (nums[i]+nums[j]+nums[k]+nums[p] > target){
						j--;
					}
					else{
						List<Integer> ans = new ArrayList<Integer>();
						ans.add(nums[p]);ans.add(nums[k]);ans.add(nums[i]);ans.add(nums[j]);
						if(!sols.contains(ans)) sols.add(ans);
						i++;
					}
					
				}
			}
		}
		return sols;
        
    }
	

}
