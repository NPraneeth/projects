package leetcode;

import java.util.Arrays;

public class two_sum {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] ans = null;
		int[] nums = {3,2,4};
		int[] orignums = nums;
		int target = 6;
		ans = twoSum(nums,target);
		System.out.println(ans[0] + " and "+ans[1]);
		return;
	}
	
	public static int[] twoSum(int[] nums, int target) {
       
        int[] orig = Arrays.copyOf(nums,nums.length);
		Arrays.sort(nums);
        int i=0;
        int j= nums.length-1;
        while(i<nums.length && j>=0){
        	//System.out.println("Loop : "+i + " and " +j);
        	if((nums[i]+nums[j]) > target){
        		j--;
        		continue;
        	}
        	else if((nums[i]+nums[j]) < target){
        		i++;
        		continue;
        	}
        	else if((nums[i]+nums[j]) == target){
        		int[] ret = new int[2];
        		int indexofnumsi = find(nums[i],orig);
        		int indexofnumsj = find(nums[j],orig);
        		ret[0]=indexofnumsi+1;
        		ret[1]=indexofnumsj+1;
        		return ret;
        	}
        }
        return null;
    }
	
	public static int find( int elem , int[] array){
		for(int i=0;i<array.length;i++){
			if(array[i]==elem){
				return i;
			}
		}
		return -1;
	}

}
