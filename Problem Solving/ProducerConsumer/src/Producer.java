import java.util.LinkedList;

public class Producer implements Runnable{
public Shared ll;
public int name;
	
	public Producer(Shared ll,int name){
		this.ll = ll;
		this.name = name;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		String fruit = null;
		while(true){
			synchronized(ll){
				fruit = ll.add();
				System.out.println(" Producer " +this.name+" is putting "+fruit);
				ll.notifyAll();
				try {
					ll.wait();
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
			}
			try {
				Thread.sleep(1000);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	}
	
}
