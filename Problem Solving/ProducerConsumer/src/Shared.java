import java.util.ArrayList;
import java.util.Arrays;
import java.util.LinkedList;
import java.util.Random;

public class Shared {
	final public ArrayList<String> s = new ArrayList<String>(Arrays.asList("Apple","Orange","Lemon","Pea","Banana"));
	public LinkedList<String> ll;
	public Shared(){
		this.ll = new LinkedList<String>();
	}
	public synchronized String add(){
		Random r = new Random();
		String fruitsadded = "";
		for(int i=0;i<2;i++){
			int rand =r.nextInt(5);
			String fruitadded = s.get(rand);
			ll.add(fruitadded);
			fruitsadded = fruitsadded.concat(fruitadded+",");
		}
		return fruitsadded;
	}
	public synchronized String eat(){
		 String fruitname=null;
		if(!ll.isEmpty())fruitname = ll.removeFirst();
		return fruitname;
	}
}
