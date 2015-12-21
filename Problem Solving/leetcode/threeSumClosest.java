package leetcode;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class threeSumClosest {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] nums = {-1,2,1,-4};
		int ans = threeSum(nums,1);
		System.out.println(ans);
	}
	
	public static int threeSum(int[] nums,int target) {
		List<List<Integer>> sols = new ArrayList<List<Integer>>();
		Arrays.sort(nums);
		int diff= Integer.MAX_VALUE;
		int sum = 0;
		for(int k=0;k<nums.length-2;k++){
		    if(k>0 && nums[k]==nums[k-1])continue; // This is to avoid duplicates being counted.
			int i=k+1;
			int j=nums.length-1;
			while(i<j){
				int newdiff = target-nums[i]-nums[j]-nums[k];
				int newsum = nums[i] + nums[j] + nums[k];
				if(nums[i]+nums[j]+nums[k] < target){
					i++;
				}
				else if (nums[i]+nums[j]+nums[k] > target){
					j--;
				}
				else{
					i++;
				}
				
				//This check is not there - after debugging came across this error
				// if k=1,i=2,j=3 and nums[i]+nums[j]+nums[k]>target we do j-- --> in this case j becomes i itself.(so diff decreases). 
				// hence added this inequality check.
				if(diff>Math.abs(newdiff)){
					diff = Math.abs(newdiff);
					sum = newsum;
				}
				
			}
		}
		return sum;
        
    }
	
}
