package leetcode;

import java.util.Arrays;

public class NextPermutation {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] nums = {1,2,3};
		new NextPermutation().nextPermutation(nums);
		int[] nums1 = {3,2,1};
		new NextPermutation().nextPermutation(nums1);
		int[] nums2 = {1,3,2};
		//Arrays.sort(nums2, 1, nums.length);
		//for(int i=0;i<nums2.length;i++)System.out.println(nums2[i]);
		new NextPermutation().nextPermutation(nums2);

	}

    public void nextPermutation(int[] nums) {
    	  int len = nums.length-1;
          int i = len;
          while(i>0 && nums[i]<=nums[i-1])
          		i--;
          if(i==0){
          	Arrays.sort(nums);
          }
          else{
          	int toModifyPos = i-1;
          	int j = len;
          	while(j>toModifyPos && nums[toModifyPos]>=nums[j])
          		j--;
          	int temp = nums[j];
          	nums[j] = nums[toModifyPos];
          	nums[toModifyPos] = temp;
          	Arrays.sort(nums, toModifyPos+1, nums.length);
          }
        for(int k=0;k<nums.length;k++){
        	System.out.print(nums[k]);
        }
        System.out.println();
    }
	
}
