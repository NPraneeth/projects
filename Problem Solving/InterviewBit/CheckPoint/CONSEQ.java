import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

public class CONSEQ {

	public int longestConsecutive(final List<Integer> a) {
		Set<Integer> s = new HashSet<Integer>();
		s.addAll(a);
		int count=0;
		int maxcount=0;
		for( Integer i : a){
			count=0;
			int k = i;
			while(s.contains(i-1)){
				count++;
				//System.out.println(i);
				s.remove(i-1);
				i--;
			}
			i=k;
			while(s.contains(i+1)){
				count++;
				s.remove(i+1);
				i++;
			}
			i=k;
			s.remove(i);
			count++;
			//System.out.println("count is "+count);
			//System.out.println("maxcount is "+maxcount);
			if(count>maxcount){
				maxcount= count;
			}
		}
		return maxcount;
	}
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		final List<Integer> l = new ArrayList<Integer>(Arrays.asList(50, 51, 15, 101, 23, 66, 69, 24, 75, 40, 30, 10, 61, 73, 95, 119, 106, 60, 26, 111, 54, 79, 18, 28, 72, 110, 37, 63, 5, 102, 53, 42, 49, -4, -2, 64, 93, 117, 103, 115, -5, 87, 47, 12, 48, 1, 9, 91, 85, -3, 68, 76, 59, 38, 35, 45, 0, 78, 62, 70, 46, 90, 52, 3, 83, 43, 11, 89, 21, 80, 77, 33, 17, 92, 113));
		CONSEQ x = new CONSEQ();
		int answer = x.longestConsecutive(l);
		System.out.println(answer);
	}

}
