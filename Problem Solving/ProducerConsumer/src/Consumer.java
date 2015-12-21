import java.util.LinkedList;

public class Consumer implements Runnable{
	public Shared ll;
	public int name;
	public Consumer(Shared ll,int name){
		this.ll = ll;
		this.name = name;
	}
	@Override
	public void run() {
		// TODO Auto-generated method stub
		String fruit = null;
		while(true){
			synchronized(ll){
				if(!ll.ll.isEmpty()){
					fruit = ll.eat();
					System.out.println("Consumer "+this.name+" is eating : "+fruit);
					
				}
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
