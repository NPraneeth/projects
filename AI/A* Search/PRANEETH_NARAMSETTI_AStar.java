
import java.util.ArrayList;
import java.util.Collections;
import java.util.Iterator;

public class PRANEETH_NARAMSETTI_AStar 
{		
	public ArrayList<SearchPoint> frontier;
	public ArrayList<SearchPoint> explored;
	public ArrayList<Map.Point> solution;
	public Map.Point endPoint;
	public int heuristic;
	
	public class SearchPoint implements Comparable<SearchPoint>
	{
		
		public Map.Point mapPoint;
		public float distanceFromSrc;
		public ArrayList<Map.Point> path;
		
		public SearchPoint(Map.Point x,float distance,ArrayList<Map.Point> path){
			this.mapPoint = x;
			this.distanceFromSrc = distance;
			this.path = path;
		}
		
		public float g() 
		{
			return this.distanceFromSrc;
		}
		
		public float h()
		{	
			if(heuristic == 0){
				return (float) 0;
			}
			else if(heuristic == 1){
				return (float) Math.abs(this.mapPoint.x - endPoint.x)+Math.abs(this.mapPoint.y - endPoint.y);
			}
			else if (heuristic == 2){
				return (float) Math.sqrt(Math.pow(this.mapPoint.x - endPoint.x, 2) + Math.pow(this.mapPoint.y - endPoint.y, 2));
			}
			return -1;
		}
		
		public float f()
		{
			return this.g()+this.h();
		}
		
		@Override
		public int compareTo(SearchPoint other)
		{
			if(this.f()<other.f())
				return -1;
			else if(this.f()>other.f())
				return 1;
			else{
				if(this.g()<other.g())
					return -1;
				else if(this.g()>other.g())
					return 1;
				else
					return 0;
			}
		}
		
		@Override
		public boolean equals(Object other)
		{
			if((this.mapPoint.x == ((SearchPoint)other).mapPoint.x) && (this.mapPoint.x == ((SearchPoint)other).mapPoint.x)) 
				return true;
			else
				return false;
		}		
	}
	
	public PRANEETH_NARAMSETTI_AStar(Map map, int H)
	{
		this.frontier = new ArrayList<SearchPoint>();
		this.explored = new ArrayList<SearchPoint>();
		this.solution = new ArrayList<Map.Point>();
		this.endPoint = map.end;
		ArrayList<Map.Point> nowpath = new ArrayList<Map.Point>();
		SearchPoint start = new SearchPoint(map.start,0,nowpath);
		this.heuristic = H;
		this.endPoint = map.end;
		frontier.add(start);
	}
	
	public void exploreNextNode() 
	{	
		if(isComplete()){
			return;
		}
		Collections.sort(frontier);
		SearchPoint point = frontier.remove(0);
		ArrayList<Map.Point> neighbors = point.mapPoint.neighbors;
		for(Map.Point n : neighbors){
			float distance = (float) Math.sqrt(Math.pow(point.mapPoint.x - n.x, 2) + Math.pow(point.mapPoint.y - n.y, 2));
			ArrayList<Map.Point> newpath = new ArrayList<Map.Point>(point.path);
			newpath.add(n);
			SearchPoint s = new SearchPoint(n,point.distanceFromSrc + distance,newpath);
			
			if(!getExplored().contains(s.mapPoint)){
				if(getFrontier().contains(s.mapPoint)){
					Iterator<SearchPoint> itr = frontier.iterator();
					while(itr.hasNext()){
						SearchPoint infrontier = itr.next();
						if(infrontier.equals(s) && infrontier.distanceFromSrc > s.distanceFromSrc){
							itr.remove();
						}
					}
					frontier.add(s);
				}
				else{
					frontier.add(s);
				}
			}
			
		}
		explored.add(point);
		if(point.mapPoint.equals((Map.Point)endPoint)){
			this.solution = point.path;
		}
		return;
	}

	public ArrayList<Map.Point> getFrontier()
	{
		ArrayList<Map.Point> frontierPoints = new ArrayList<Map.Point>();
		for ( SearchPoint s : frontier ){
			frontierPoints.add(s.mapPoint);
		}
		return frontierPoints;
	}
	
	public ArrayList<Map.Point> getExplored()
	{
		ArrayList<Map.Point> exploredPoints = new ArrayList<Map.Point>();
		for( SearchPoint s : explored){
			exploredPoints.add(s.mapPoint);
		}
		return exploredPoints;
	}

	public boolean isComplete()
	{
		if(frontier.isEmpty())
			return true;
		if(getExplored().contains(endPoint)){
			
			return true;
		}
		return false;
	}

	public ArrayList<Map.Point> getSolution()
	{
		if(isComplete())
			return solution;
		return null;
	}	
}
