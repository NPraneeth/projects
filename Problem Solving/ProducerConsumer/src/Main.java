import java.util.LinkedList;

public class Main {

	public static void main(String[] args) throws InterruptedException {
		// TODO Auto-generated method stub
		Shared s = new Shared();
		Thread p = new Thread(new Producer(s,1));
		Thread c1 = new Thread(new Consumer(s,1));
		Thread c2 = new Thread(new Consumer(s,2));
		p.start();
		c1.start();
		c2.start();
		p.join();
		c1.join();
		c2.join();
		
	}

}
