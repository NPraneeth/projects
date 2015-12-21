import java.util.ArrayList;

public class INVERSIONS {

	
	public static int countInversions(ArrayList<Integer> a) {
		int[] newa = new int[a.size()];
		for(int i=0;i<a.size();i++){
			newa[i] = a.get(i);
		}
		int ans = countInv(newa,0,a.size()-1);
		//System.out.println(ans);
		return ans;
	}
	
	public static int countInv(int[] a,int left, int right){
			if(left==right) return 0;
			if(left<right){
				int mid = left + (right-left)/2;
				int leftinv = countInv(a,left,mid);
				int rightinv = countInv(a,mid+1,right);
				int crossInv = merge(a,left,mid,right);
				return leftinv + rightinv + crossInv;
			}
			return 0;
	}
	
	public static int merge(int[] a, int left, int mid, int right){
		int[] tmp = new int[right-left+1];
		int invs=0;
		int k = 0;
		int i = left;
		int j = mid+1;
		while(i<=mid && j<=right){
			if(a[i] <= a[j]){
				tmp[k]=a[i];
				i++;k++;
			}
			else{
				invs += mid-i+1;
				tmp[k]=a[j];
				j++;k++;
//				System.out.println("Inversin changed to :"+invs);
			}
		}
		while(i<=mid){
			tmp[k]=a[i];
			i++;k++;
		}
		while(j<=right){
			tmp[k]=a[j];
			j++;k++;
		}
		int l;
		for(l=left,k=0;l<=right;l++,k++){
			a[l] = tmp[k];
//			System.out.print(tmp[k]+" ");
		}
//		System.out.println();
		return invs;
	}
	
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		
		ArrayList<Integer> a = new ArrayList<Integer>();
		a.add(2);
		a.add(4);
		a.add(1);
		a.add(3);
		a.add(5);
		int ans = countInversions(a);
		System.out.println(ans);
		
	}

}
