

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashSet;
import java.util.Set;

import processing.core.PApplet;
import processing.data.XML;

public class PRANEETH_NARAMSETTI_Resolution extends DrawableTree
{
	public PRANEETH_NARAMSETTI_Resolution(PApplet p, XML tree) 
	{ 
		super(p); 
		this.tree = tree; 
		dirtyTree = true;
	}
		
	public void eliminateBiconditions()
	{
		if(tree==null)return;
		if(tree.getChildCount()==0)return;
		myeliminateBiConditions(tree);
		
		// TODO - Implement the first step in converting logic in tree to CNF:
		// Replace all biconditions with truth preserving conjunctions of conditions.
		dirtyTree=true;
	}	
	
	private void myeliminateBiConditions(XML tree) {
		if(tree==null) return;
		XML[] children = tree.getChildren();
		for (XML eachChild : children){
			if(eachChild.getName().equals("bicondition")){
				XML biconditionalParent = eachChild.getParent();
				XML newBi = biconditionalParent.addChild("and");
				XML firstCondition = newBi.addChild("condition");
				XML secondCondition = newBi.addChild("condition");
				XML[] elems = eachChild.getChildren();
				
				XML firstCondLeft = firstCondition.addChild(elems[0]);
				XML firstCondRight = firstCondition.addChild(elems[1]);
				XML secondCondLeft = secondCondition.addChild(elems[1]);
				XML secondCondRight = secondCondition.addChild(elems[0]);
				biconditionalParent.removeChild(eachChild);
				//System.out.println(tree);
				myeliminateBiConditions(firstCondition);
				myeliminateBiConditions(secondCondition);
			}
			else{
				myeliminateBiConditions(eachChild);
			}
		}
		// TODO Auto-generated method stub
		
	}

	public void eliminateConditions()
	{
		// TODO - Implement the second step in converting logic in tree to CNF:
		// Replace all conditions with truth preserving disjunctions.
		if(tree==null)return;
		if(tree.getChildCount()==0)return;
		myeliminateConditions(tree);
		dirtyTree=true;
	}
		
	private void myeliminateConditions(XML tree) {
		if(tree==null) return;
		XML[] children = tree.getChildren();
		for (XML eachChild : children){
			if(eachChild.getName().equals("condition")){
				XML conditionalParent = eachChild.getParent();
				XML newCon = conditionalParent.addChild("or");
				XML negCondition = newCon.addChild("not");
				XML[] elems = eachChild.getChildren();
				XML Left = negCondition.addChild(elems[0]);
				XML Right = newCon.addChild(elems[1]);
				conditionalParent.removeChild(eachChild);
				//System.out.println(tree);
				myeliminateConditions(Left);
				myeliminateConditions(Right);
			}
			else{
				myeliminateConditions(eachChild);
			}
		}
		// TODO Auto-generated method stub
		
	}

	public void moveNegationInwards()
	{
		// TODO - Implement the third step in converting logic in tree to CNF:
		// Move negations in a truth preserving way to apply only to literals.
		if(tree==null)return;
		if(tree.getChildCount()==0)return;
		mymoveNegationInwards(tree);
		dirtyTree=true;
	}
		
	private void mymoveNegationInwards(XML tree) {
		if(tree==null) return;
		XML[] children = tree.getChildren();
		for (XML eachChild : children){
			if(eachChild.getName().equals("not")){
				XML notParent = eachChild.getParent();
				XML notChild = eachChild.getChild(0);
				XML newNot = null;
				if(notChild.getName().equals("and") || notChild.getName().equals("or")){
					if(notChild.getName().equals("and"))
						newNot = notParent.addChild("or");
					else if(notChild.getName().equals("or"))
						newNot = notParent.addChild("and");
					XML notChildandleftChild = notChild.getChild(0);
					XML notChildandrightChild = notChild.getChild(1);
					XML andleft = newNot.addChild("not");
					XML andright = newNot.addChild("not");
					XML finalleft = andleft.addChild(notChildandleftChild);
					XML finalright = andright.addChild(notChildandrightChild);
				}
				else if(notChild.getName().equals("not")){
					newNot = notParent.addChild(notChild.getChild(0));
				}
				else{
					continue;
				}
					notParent.removeChild(eachChild);
					mymoveNegationInwards(newNot);
			}
			else{
				mymoveNegationInwards(eachChild);
			}
		}
		// TODO Auto-generated method stub
		
	}

	public void distributeOrsOverAnds()
	{
		// TODO - Implement the fourth step in converting logic in tree to CNF:
		// Move negations in a truth preserving way to apply only to literals.
		if(tree==null)return;
		if(tree.getChildCount()==0)return;
		mydistributeOrsOvereAnds(tree);
		dirtyTree = true;
	}
		
	private void mydistributeOrsOvereAnds(XML tree) {
		if(tree==null) return;
		XML[] children = tree.getChildren();
		for(XML eachChild : children){
			if(eachChild.getName().equals("or")){
				XML orParent = eachChild.getParent();
				XML[] orChildren = eachChild.getChildren();
				XML orsandChild = null;
				XML orsotherChild = null;
				if(orChildren[0].getName().equals("and")){
					orsandChild = orChildren[0];
					orsotherChild = orChildren[1];
				}
				else if(orChildren[1].getName().equals("and")){
					orsandChild = orChildren[1];
					orsotherChild = orChildren[0];
				}
				else{
					continue;
				}
				XML andleftChild = orsandChild.getChild(0);
				XML andrightChild = orsandChild.getChild(1);
				XML newOr = orParent.addChild("and");
				XML newOrleft = newOr.addChild("or");
				XML newOrright = newOr.addChild("or");
				XML leftorleft = newOrleft.addChild(orsotherChild);
				XML leftorright = newOrleft.addChild(andleftChild);
				XML rightorleft = newOrright.addChild(orsotherChild);
				XML rightorright = newOrright.addChild(andrightChild);
				orParent.removeChild(eachChild);
				mydistributeOrsOvereAnds(newOr);
				
				
			}
			else{
				mydistributeOrsOvereAnds(eachChild);
			}
		}
		// TODO Auto-generated method stub
		
	}

	public void collapse()
	{
		// TODO - Clean up logic in tree in preparation for Resolution:
		// 1) Convert nested binary ands and ors into n-ary operators so
		// there is a single and-node child of the root logic-node, all of
		// the children of this and-node are or-nodes, and all of the
		// children of these or-nodes are literals: either atomic or negated	
		// 2) Remove redundant literals from every clause, and then remove
		// redundant clauses from the tree.
		// 3) Also remove any clauses that are always true (tautologies)
		// from your tree to help speed up resolution.
		if(tree==null || tree.getChildCount()==0){
			return;
		}
		removeNestedAnds(tree.getChild(0));
		removeNestedOrs(tree.getChild(0));
		andLiteralChildrentoOr(tree.getChild(0));
		removeRedundantLiteralsfromOrs(tree.getChild(0));
		removeRedundantClausesfromAnds(tree.getChild(0));
		removeTautologies(tree.getChild(0));
		
		dirtyTree=true;
	}	
	
	
	private void andLiteralChildrentoOr(XML root) {
		// TODO Auto-generated method stub
		if((!root.getName().equals("or")) && (!root.getName().equals("and")) && !root.getName().equals("not"))
			return;
		if(root.getName().equals("and")){
			XML[] children = root.getChildren();
			for( int i =0;i<children.length;i++){
				if(!children[i].getName().equals("or")){
					XML now = new XML("or");
					now.addChild(children[i]);
					root.removeChild(children[i]);
					root.addChild(now);
				}
			}
		}
	}

	private void removeTautologies(XML root) {
		if((!root.getName().equals("or")) && (!root.getName().equals("and")))
			return;
		
		if(root.getName().equals("or")){
			XML[] children = root.getChildren();
			for(XML eachChildren : children){
				//considering "or" will have all literals only.
				if(isLiteralNegated(eachChildren)){
					String atom = getAtomFromLiteral(eachChildren);
					if(clauseContainsLiteral(root, atom, false)){
						XML rootParent = root.getParent();
						if(rootParent==null){
							root = null;
							return;
						}
						rootParent.removeChild(root);
						if(rootParent.getName().equals("and") && rootParent.getChildCount()==0){
							XML nowParent = rootParent.getParent();
							nowParent.removeChild(rootParent);
							return;
						}
						break;
					}
				}
				else{
					if(clauseContainsLiteral(root, eachChildren.getName(), true)){
						XML rootParent = root.getParent();
						if(rootParent==null){
							root = null;
							return;
						}
						rootParent.removeChild(root);
						if(rootParent.getName().equals("and") && rootParent.getChildCount()==0){
							XML nowParent = rootParent.getParent();
							nowParent.removeChild(rootParent);
							return;
						}
						break;
					}
				}
			}
		}
		else{
			XML[] allChildren = root.getChildren();
			for( XML eachChild : allChildren){
				removeTautologies(eachChild);
			}
		}
		
	}

	private void removeRedundantClausesfromAnds(XML root) {
		if((!root.getName().equals("or")) && (!root.getName().equals("and")) && !root.getName().equals("not"))
			return;
		if(root.getName().equals("and")){
			XML[] children = root.getChildren();
			for( XML eachChildren : children){
				root.removeChild(eachChildren);
				//System.out.println(root.getChildren().length);
				
				
				if(setContainsClause(root, eachChildren)){
					continue;
				}
				else{
					root.addChild(eachChildren);
				}
				//System.out.println(root.getChildCount());
			}
		}
		else{
			XML[] allChildren = root.getChildren();
			for( XML eachChild : allChildren){
				removeRedundantClausesfromAnds(eachChild);
			}
		}
		
	}

	private void removeRedundantLiteralsfromOrs(XML root) {
		if((!root.getName().equals("or")) && (!root.getName().equals("and")) && !root.getName().equals("not"))
			return;
		if(root.getName().equals("or")){
			XML[] children = root.getChildren();
			for(XML eachChildren : children){
				root.removeChild(eachChildren);
				if(isLiteralNegated(eachChildren)){
					if(clauseContainsLiteral(root, eachChildren.getChild(0).getName(), true)){
						continue;
					}
					else{
						root.addChild(eachChildren);
					}
				}
				else{
					if(clauseContainsLiteral(root, eachChildren.getName(), false)){
						continue;
					}
					else{
						root.addChild(eachChildren);
					}
				}
			}
		}
		else{
			XML[] allChildren = root.getChildren();
			for( XML eachChild : allChildren){
				removeRedundantLiteralsfromOrs(eachChild);
			}
		}
	}

	private void removeNestedAnds(XML root) {
		if(!root.getName().equals("and"))
			return;
		XML[] andChildrens = root.getChildren("and");
		for( XML eachAndChild : andChildrens){
			removeNestedAnds(eachAndChild);
			XML[] toPushUp = eachAndChild.getChildren();
			for ( XML eachToPushUp : toPushUp){
				XML dummy = root.addChild(eachToPushUp);
			}
			root.removeChild(eachAndChild);;
		}
	}
	
	private void removeNestedOrs(XML root) {
		if((!root.getName().equals("or")) && (!root.getName().equals("and")) && !root.getName().equals("not"))
			return;
		if(root.getName().equals("or")){
			XML[] orChildren = root.getChildren("or");
			if(orChildren.length <= 0)
				return;
			for(XML eachOrChildren : orChildren){
				removeNestedOrs(eachOrChildren);
				XML[] toPushUp = eachOrChildren.getChildren();
				for ( XML eachToPushUp : toPushUp){
					XML dummy = root.addChild(eachToPushUp);
				}
				root.removeChild(eachOrChildren);
			}
		}
		else{
			XML[] allChildren = root.getChildren();
			for( XML eachChild : allChildren){
				removeNestedOrs(eachChild);
			}
		}
	}
	
	public boolean applyResolution()
	{
		// TODO - Implement resolution on the logic in tree.  New resolvents
		// should be added as children to the only and-node in tree.  This
		// method should return true when a conflict is found, otherwise it
		// should only return false after exploring all possible resolvents.
		// Note: you are welcome to leave out resolvents that are always
		// true (tautologies) to help speed up your search.
		//System.out.println("I am in applyResolution");
		if(tree==null)return false;
		if(tree.getChildCount()==0)return false;
		XML root = tree.getChild(0);
		
		XML[] allClausesArray = root.getChildren();
		ArrayList<XML> allClauses = new ArrayList<XML>(Arrays.asList(allClausesArray));
		removeRedundantLiteralsfromOrs(root);
		removeRedundantClausesfromAnds(root);
		removeTautologies(root);
		for(int i=0;i<root.getChildCount();i++){
			for(int j=i+1;j<root.getChildCount();j++){
				dirtyTree=true;
				
				XML curr = resolve(root.getChildren()[i],root.getChildren()[j]);
				//System.out.println(curr);
				if(curr==null){
					continue;
				}
				else if(curr.getChildCount()==0){
					return true;
				}
				else{
					root.addChild(curr);
					//i=0;
					//allClauses.add(curr);
					//allClauses = root.getChildren();
				}
				removeRedundantLiteralsfromOrs(root);
				removeRedundantClausesfromAnds(root);
				removeTautologies(root);
			}
		}
		
		return false;
	}

	public XML resolve(XML clause1, XML clause2)
	{
		// TODO - Attempt to resolve these two clauses and return the resulting
		// resolvent.  You should remove any redundant literals from this 
		// resulting resolvent.  If there is a conflict, you will simply be
		// returning an XML node with zero children.  If the two clauses cannot
		// be resolved, then return null instead.
		
		if(clause1==null || clause2==null){
			return null;
		}
		
		
		boolean isResolved = false;
		boolean allBreak = false;
		
		XML now = new XML("or");
		XML[] clause1children = clause1.getChildren();
		XML[] clause2children = clause2.getChildren();
		for(XML eachChildren1 : clause1children){
			now.addChild(eachChildren1);
		}
		for(XML eachChildren2 : clause2children){
			now.addChild(eachChildren2);
		}
		
		for(XML eachChild1 : clause1children){
			for(XML eachChild2 : clause2children){
				if(isLiteralNegated(eachChild1)){
					String atom = getAtomFromLiteral(eachChild1);
					if(clauseContainsLiteral(clause2, atom, false)){
						
						now = removeLiteralChild(now, eachChild1.getChild(0).getName());
						allBreak = true;
						isResolved=true;
						break;
					}
				}
				else{
					String atom = eachChild1.getName();
					if(clauseContainsLiteral(clause2, atom, true)){
						now = removeLiteralChild(now, eachChild1.getName());
						allBreak=true;
						isResolved=true;
						break;
					}
				}	
			}
			if(allBreak==true){
				break;
			}
		}
		if(isResolved==false)
			return null;
		else{
			return now;
		}
	}	
	
	public XML removeLiteralChild(XML main, String atom){
		XML[] children = main.getChildren();
		for(int i=0;i<children.length;i++){
			if(children[i].getName().equals("not")){
				if(children[i].getChild(0).getName().equals(atom)){
					main.removeChild(children[i]);
				}
			}
			else{
				if(children[i].getName().equals(atom)){
					main.removeChild(children[i]);
				}
			}
		}
		return main;
	}
	
	// REQUIRED HELPERS: may be helpful to implement these before collapse(), applyResolution(), and resolve()
	// Some terminology reminders regarding the following methods:
	// atom: a single named proposition with no children independent of whether it is negated
	// literal: either an atom-node containing a name, or a not-node with that atom as a child
	// clause: an or-node, all the children of which are literals
	// set: an and-node, all the children of which are clauses (disjunctions)
		
	public boolean isLiteralNegated(XML literal) { 
		return literal.getName().equals("not")?true:false; 
	}

	public String getAtomFromLiteral(XML literal) { 
		return isLiteralNegated(literal)?literal.getChild(0).getName():literal.getName();
	}	
	
	public boolean clauseContainsLiteral(XML clause, String atom, boolean isNegated){
		if(isNegated){
			XML[] clauseChildren = clause.getChildren("not");
			for ( XML negatedChild : clauseChildren){
				if(negatedChild.getChildren(atom).length>0){
					return true;
				}
			}
		}
		else{
			XML[] clauseChildren = clause.getChildren(atom);
			if(clauseChildren.length>0)
				return true;
		}
		return false;
	}
	
	public boolean setContainsClause(XML set, XML clause){
		XML[] setChildren = set.getChildren();
		for ( XML eachChild : setChildren ){
			if(myequals(eachChild,clause))
				return true;
		}
		return false;
	}
	
	private boolean myequals(XML left, XML right) {
		// TODO Auto-generated method stub
		XML[] lChildren = left.getChildren();
		XML[] rChildren = right.getChildren();
		Set<String> lset = new HashSet<String>();
		Set<String> lnotset = new HashSet<String>();
		Set<String> rset = new HashSet<String>();
		Set<String> rnotset = new HashSet<String>();
		for(XML lChild : lChildren){
			if(lChild.getName().equals("not")){
				lnotset.add(lChild.getChild(0).getName());
			}
			else{
				lset.add(lChild.getName());
			}
		}
		for(XML rChild : rChildren){
			if(rChild.getName().equals("not")){
				rnotset.add(rChild.getChild(0).getName());
			}
			else{
				rset.add(rChild.getName());
			}
		}
		if(lset.equals(rset) && lnotset.equals(rnotset)){
			return true;
		}
		else return false;
	}

	public boolean clauseIsTautology(XML clause){
		XML[] clauseChildren = clause.getChildren();
		for( XML eachChild : clauseChildren ){
			if(isLiteralNegated(eachChild)){
				String atom = getAtomFromLiteral(eachChild);
				XML[] children = clause.getChildren();
				for (XML eChild : children){
					if(eChild.getName().equals(atom))
						return true;
				}
			}
		}
		return false;
	}	
	
}

