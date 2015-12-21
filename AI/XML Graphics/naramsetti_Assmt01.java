
import processing.data.*;
import processing.core.*;
import java.util.LinkedList;

public class naramsetti_Assmt01 extends PApplet{

	public naramsetti_Assmt01() {
		// TODO Auto-generated constructor stub
	}

	
	private XML data;
	private boolean keyAlreadyPressed;
	private int[] x={-10,10,-10,10};
	private int[] y={-10-10,10,10};
	
	public void loadBoxes(String filename)
	{
		// TODO: implement this method in step 1
		data = loadXML(filename);
		if(data==null)return;
		
		LinkedList<XML> ll = new LinkedList<XML>();
		ll.push(data);
		while(!ll.isEmpty()){
			XML now = ll.pollFirst();
			if(now!=null){
				XML[] children = now.getChildren();
				int childcount = now.getChildCount();
				for(int k=0;k < childcount;k++){
					if(children[k].getName().equals("#text")){
						now.removeChild(children[k]);
					}
					else{
						ll.addLast(children[k]);
					}
				}
			}
		}
	}
		
	public void drawBoxes(XML xml, int x, int y){
			if(xml==null) return;
			if(xml.getName().equals("boxes")){
				XML[] boxesChildren = xml.getChildren();
				for(int i=0;i<xml.getChildCount();i++){
					drawBoxes(boxesChildren[i],x,y);
				}
			}
			if(xml.getName().equals("move")){
				int xmovement = xml.getInt("x");
				int ymovement = xml.getInt("y");
				XML[] moveChildren = xml.getChildren();
				for(int i=0;i<xml.getChildCount();i++){
					drawBoxes(moveChildren[i],x+xmovement,y+ymovement);
				}
			}
			if(xml.getName().equals("box")){
				rect(x,y,20,20);
				return;
			}
	}
	
	public void doubleMoves(XML xml)
	{

		// TODO: implement this method in step 3
		//System.out.println("I am in double Moves");
		if(xml==null) return;
		if(xml.getName().equals("boxes")){
			XML[] boxesChildren = xml.getChildren();
			for(int i=0;i<xml.getChildCount();i++){
				doubleMoves(boxesChildren[i]);
			}
		}
		if(xml.getName().equals("move")){
			xml.setInt("x",xml.getInt("x")*2);
			xml.setInt("y",xml.getInt("y")*2);
			XML[] moveChildren = xml.getChildren();
			for(int i=0;i<xml.getChildCount();i++){
				doubleMoves(moveChildren[i]);
			}
		}
		if(xml.getName().equals("box")){
			return;
		}
	}
	
	public void doubleBoxes(XML xml)
	{
		// TODO: implement this method in step 4
		if(xml==null)return;
		//System.out.println("starting the double boxes call");
		XML[] children = xml.getChildren();
		int childrenCount = xml.getChildCount();
		for(int i =0;i<childrenCount;i++){
			if(children[i].getName().equals("box")){
				xml.removeChild(children[i]);
				XML moveNode = new XML("move");moveNode.setInt("x", 10);moveNode.setInt("y", 10);moveNode.addChild("box");
				xml.addChild(moveNode);
				moveNode = new XML("move");moveNode.setInt("x", 10);moveNode.setInt("y", -10);moveNode.addChild("box");
				xml.addChild(moveNode);
				moveNode = new XML("move");moveNode.setInt("x", -10);moveNode.setInt("y", 10);moveNode.addChild("box");
				xml.addChild(moveNode);
				moveNode = new XML("move");moveNode.setInt("x", -10);moveNode.setInt("y", -10);moveNode.addChild("box");
				xml.addChild(moveNode);
			}
			else{
				doubleBoxes(children[i]);
			}
		}
		
	}
	
	// tie key press events to calling the functions above:
	// 1 - loadBoxes
	// 2 - drawBoxes
	// 3 - doubleMoves
	// 4 - doubleBoxes             
	public void draw()
	{
		if(keyPressed)
		{
			if(keyAlreadyPressed == false)
			{
				switch(key)
				{
				case '1':
					loadBoxes("boxData.xml");
					break;
				case '2':
					background( 255 );
					drawBoxes(data, width/2, height/2);	
					save("output.png");
					break;
				case '3':
					doubleMoves(data);		
					break;
				case '4':
					doubleBoxes(data);		
					break;
				}
			}
			keyAlreadyPressed = true;
		}
		else
			keyAlreadyPressed = false;
	}

	// basic processing setup: window size and background color
	public void setup()
	{
		size( 800, 600 );
		background( 255 );
		data = null;
		keyAlreadyPressed = true;
	}
		
	// run as an Application instead of as an Applet
	public static void main(String[] args) 
	{
		String thisClassName = new Object(){}.getClass().getEnclosingClass().getName();
		PApplet.main( new String[] { thisClassName } );
		
	}

}
