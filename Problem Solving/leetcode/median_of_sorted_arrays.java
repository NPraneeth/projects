package leetcode;

public class median_of_sorted_arrays {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		int[] A = {2,3,7,10};
		int[] B = {4,5};
		double ans = new median_of_sorted_arrays().findMedianSortedArrays(A, B);
		System.out.println(ans);

	}
	
	public double findMedianSortedArrays(int[] A, int[] B) {
        int m = A.length, n = B.length;
        int l = (m + n + 1) / 2;
        int r = (m + n + 2) / 2;
        return (getkth(A, 0, B, 0, l) + getkth(A, 0, B, 0, r)) / 2.0;
    }

public double getkth(int[] A, int aStart, int[] B, int bStart, int k) {
	System.out.println(aStart + " " + bStart + " " + k);
    if (aStart > A.length - 1) return B[bStart + k - 1];            
    if (bStart > B.length - 1) return A[aStart + k - 1];                
    if (k == 1) return Math.min(A[aStart], B[bStart]);

    int aMid = Integer.MAX_VALUE, bMid = Integer.MAX_VALUE;
    if (aStart + k/2 - 1 < A.length) aMid = A[aStart + k/2 - 1]; 
    if (bStart + k/2 - 1 < B.length) bMid = B[bStart + k/2 - 1];        

    if (aMid < bMid) 
        return getkth(A, aStart + k/2, B, bStart,       k - k/2);// Check: aRight + bLeft 
    else 
        return getkth(A, aStart,       B, bStart + k/2, k - k/2);// Check: bRight + aLeft
}
}
