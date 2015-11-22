import java.util.ArrayList;
import java.util.Arrays;
import java.util.Stack;

public class NEXTGREATER {

	
	public static ArrayList<Integer> nextGreater(ArrayList<Integer> a) {
		int[] nextGreater = new int[a.size()];
		Arrays.fill(nextGreater, -1);
		if(a.isEmpty()) return null;
		
		Stack<Integer> nums = new Stack<Integer>();
		Stack<Integer> indexes = new Stack<Integer>();
		nums.push(a.get(0));indexes.push(0);
		int next=1;
		while(next < a.size()){
			while(!nums.isEmpty() && next<a.size()-1 && a.get(next)<=nums.peek() ){
				nums.push(a.get(next));
				indexes.push(next);
				next++;
			}
			
			while(!nums.isEmpty() && a.get(next)>nums.peek()){
				Integer toPopNum = nums.pop();
				Integer toPopIndex = indexes.pop();
				nextGreater[toPopIndex] =  a.get(next);
			}
			nums.push(a.get(next));
			indexes.push(next);
			next++;
		}
		ArrayList<Integer> nextGreaterList = new ArrayList<Integer>();
		for(int i=0;i<nextGreater.length;i++){
			nextGreaterList.add(nextGreater[i]);
		}
		return nextGreaterList;
	}
	
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		ArrayList<Integer> input = new ArrayList<Integer>(Arrays.asList(4,5,2,3,10));
		ArrayList<Integer> output = null;
		output = nextGreater(input);
		for(int i=0;i<output.size();i++){
			System.out.println(output.get(i)+ " ");
		}
		return;
	}

}
