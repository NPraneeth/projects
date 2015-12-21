package leetcode;

public class range_sum_query_immutable {


	    public int[] nums = null;
	    public int[] cumsumms = null;
	    public range_sum_query_immutable(int[] nums) {
	        this.nums = nums;
	        int total = 0;
	        int size = nums.length + 1;
	        this.cumsumms = new int[size];
	        cumsumms[0]=0;
	        for(int i=0;i<nums.length;i++){
	            total += nums[i];
	            cumsumms[i+1]=total;
	            System.out.println("cumsums["+i+1+"] is" + cumsumms[i+1]);
	        }
	    }

	    public int sumRange(int i, int j) {
	        return cumsumms[j+1]-cumsumms[i];
	    }

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] nums = {-2,0,3,-5,2,-1};
		range_sum_query_immutable x = new range_sum_query_immutable(nums);
		int first = x.sumRange(0,2);
		System.out.println(first);
		System.out.println(x.sumRange(2,5));
		System.out.println(x.sumRange(0, 5));
		
	}

}
