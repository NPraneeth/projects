import java.util.Random;

public class KTHSMALLEST {

	public static int partition(int a[],int left,int right){
		Random r = new Random();
		int i= left;
		int j = right;
		int temp;
		int pivot = left + r.nextInt(right-left);
		int pivotelem = a[pivot];
		System.out.println("Array analyzed is from "+left+" to " + right +" and "+ pivot + ","+pivotelem+" is choosen as the pivot here");
		while(i<j){
			while(i<=right && a[i]<pivotelem )i++;
			while(a[j]>pivotelem && j>=left)j--;
			if(i<=j){
			temp = a[j];
			a[j]=a[i];
			a[i]=temp;
			i++;
			j--;
			}
		}
		
		System.out.println("After partition array is");
		for(int k=left;k<=right;k++){
			System.out.print(a[k]+ " ");
		}
		System.out.println("pospart is "+j);
		
		return j;
	}
	
	public static int findkthsmallest(int a[],int left,int right, int kth){
		
		if(kth==1 && left==right)return a[left];
		int pospart = partition(a,left,right); //pospart is position.. In the left there will be pospart+1 elements
		//if(kth==pospart+1)return a[pospart];
		if(kth <= pospart+1-left){
			return findkthsmallest(a,left,pospart,kth);
		}
		else{
			return findkthsmallest(a,pospart+1,right,kth-pospart-1+left);
		}
		
	}
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int a[] = {2,1,4,3,2};
		int kth = 4;
		int ans= findkthsmallest(a,0,a.length-1,kth);
		System.out.println(ans +" is the answer.");
		return;
	}

}
