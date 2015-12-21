package leetcode;

public class max_profit_stocks_one_trans {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] prices = {7,2,4,1};
		int ans = new max_profit_stocks_one_trans().maxProfit(prices);
		System.out.println(ans);
		
	}

	public int maxProfit(int[] prices) {
        if(prices.length==0 || prices.length==1)return 0;
        int min1 = Integer.MAX_VALUE;
        int max1 = Integer.MIN_VALUE;
        int storeindex1=0;
        int storeindex2=0;
        int min2 = Integer.MAX_VALUE;
        int max2 = Integer.MIN_VALUE;
        for(int i=0;i<prices.length;i++){
            if(prices[i]>max1){
                max1=prices[i];
                storeindex1 = i;
            }
            if(prices[i]<min2){
                min2=prices[i];
                storeindex2 = i;
            }
        }
        for(int j=0;j<storeindex1;j++){
            if(prices[j]<min1){
                min1 = prices[j];
            }
        }
        for(int j=storeindex2+1;j<prices.length;j++){
            if(prices[j]>max2){
                max2 = prices[j];
            }
        }
        if((min1==Integer.MAX_VALUE) && (max2==Integer.MIN_VALUE))return 0;
        else if(min1==Integer.MAX_VALUE) return max2-min2;
        else if(max2==Integer.MIN_VALUE) return max1-min1;
        else return Math.max(max1-min1,max2-min2);
    }
	
}
