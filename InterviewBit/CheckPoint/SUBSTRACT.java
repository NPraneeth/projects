
 class ListNode {
      public int val;
      public ListNode next;
     ListNode(int x) { val = x; next = null; }
 }

public class SUBSTRACT {
	
	public static void printll(ListNode a){
		if(a != null){
			System.out.print(a.val + " ");
			printll(a.next);
		}
		else{
			System.out.println();
		}
		return;
	}
	
	public static ListNode reversell(ListNode a){
		if(a==null) return null;
		if(a.next ==  null ) return a;
		ListNode prev,curr,temp;
		prev = a;
		curr = prev.next;
		while(curr.next != null){
			temp = curr.next;
			curr.next = prev;
			prev = curr;  // prev.next enduku pani cheyyadem leedu ikkada
			curr = temp;
		}
		curr.next = prev;
		a.next = null;
		return curr;
		
	}
	
	public static ListNode subtract(ListNode a) {
		if(a==null)return null;
		if(a.next == null) return a;
		ListNode slowptr = a;
		ListNode fastptr = a;
		while(fastptr.next !=null && fastptr.next.next!=null){
			slowptr = slowptr.next;
			fastptr = fastptr.next.next;
		}
		ListNode secondhalf = slowptr.next;
		slowptr.next = null;
		ListNode firsthalf = a;
		ListNode secondhalfreversed = reversell(secondhalf);
		ListNode firstptr = firsthalf;
		ListNode secondptr = secondhalfreversed;
		while(secondptr.next != null){
			firstptr.val = secondptr.val - firstptr.val;
			firstptr = firstptr.next;
			secondptr = secondptr.next;
		}
		firstptr.val = secondptr.val - firstptr.val;
		ListNode secondhalfrerev = reversell(secondhalfreversed);
		ListNode firsthalfnow = a;
		while(firsthalfnow.next != null) firsthalfnow = firsthalfnow.next;
		firsthalfnow.next = secondhalfrerev;
		return a;
		
		
	}

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		ListNode a1 = new ListNode(1);
		
	/*
		ListNode a2 = new ListNode(2);
		ListNode a3 = new ListNode(3);
		ListNode a4 = new ListNode(4);
		ListNode a5 = new ListNode(5);
	*/
		//ListNode a6 = new ListNode(6);
		//ListNode a7 = new ListNode(7);
	/*
		a1.next = a2;
		a2.next = a3;
		a3.next = a4;
		a4.next = a5;
	*/
		//a5.next = a6;
		//a6.next = a7;
		ListNode afterSubstract = subtract(a1);
		/*
		printll(a1);System.out.println();
		ListNode revlist = reversell(a1);
		printll(revlist);
		*/
		
	}

}
