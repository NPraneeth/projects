import java.util.ArrayList;

public class NUMRANGE {
	public static int numRange(ArrayList<Integer> a, int b, int c) {
		ArrayList<Integer> cummsum = new ArrayList<Integer>();
		int ans=0;
		int sumnow = 0;
		cummsum.add(sumnow);
		System.out.print(sumnow + " ");
		for(int i=0;i<a.size();i++){
			sumnow += a.get(i);
			cummsum.add(sumnow);
			System.out.print(sumnow+ " ");
		}
		System.out.println();
		ans = count_all_subarrays(cummsum,0,cummsum.size()-1,b,c);
		return ans;
	}	
	
	public static int count_all_subarrays(ArrayList<Integer> a, int left, int right, int xrange, int yrange){
		if(xrange==0 && yrange==0) return 0;
		int i=0;
		int j=0;
		int k=0;
		int ans = 0;
		while(i<a.size()){
			while(j<a.size() && (int)(a.get(j)-a.get(i)) < xrange )j++;
			while(k<a.size() && (int)(a.get(k)-a.get(i)) <= yrange )k++;
			if(j<k){
				ans += k-j;
			}
			i++;
		}
		return ans;
	}
	
	public static int search_elements_between(ArrayList<Integer> a, int left, int right, int xrange, int yrange){
		if(left <= right){
			int mid = left + (right-left)/2;
			if(a.get(mid)>xrange && a.get(mid)>yrange && mid>left){
				return search_elements_between(a,left,mid-1,xrange,yrange);
			}
			else if(a.get(mid)<xrange && a.get(mid)<yrange && mid<right){
				return search_elements_between(a,mid+1,right,xrange,yrange);
			}
			else if(a.get(mid)>=xrange && a.get(mid)<=yrange){
				return search_elements_between(a,left,mid-1,xrange,yrange)+search_elements_between(a,mid+1,right,xrange,yrange)+1;
			}
		}
		return 0;
	}
	
	public static void main(String args[]){
		int list[] = {10,5,1,0,2};
		ArrayList<Integer> a = new ArrayList<Integer>();
		a.add(1);
		int ans = numRange(a, 0, 0);
		System.out.println(ans);
		ArrayList<Integer> b = new ArrayList<Integer>();
		b.add(10);b.add(5);b.add(1);b.add(0);b.add(2);b.add(0);
		ans = 0;
		ans = numRange(b,6,8);
		System.out.println(ans);
		return ;
	}
}