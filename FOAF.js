/*
	Author: R.Henson 2016
	A Simple example to demonstrate structure of a social networks.
	Uses a brute force depth first search technique in order to explore the social network
	and an occurance matrix to map the links between friends
*/

var NETWORK = new Array ();
var MATRIX = new Array();
var PATHS = null;

function Friend(i,n,l) {
   this.id = i
   this.name  = n;
   this.links = l;
 
   this.getName = function () {
        return this.name;
   }
}

function Link (n,w) {
	if (typeof Link.i === 'undefined')
		Link.i = 1; 
	else
		Link.i++;
	this.id = Link.i;
	this.friend = n;
	this.weight = w;
}

function getFriend (name) {
	for (var i=0;i<NETWORK.length;i++) {
		if (name==NETWORK[i].name) return NETWORK[i];
	}
}

function getLinks (name) {
	var friend =  getFriend (name);
	return friend.links
}
function getLinkIndex(){
	return Link.i;
}

function getNextLinkIndex(obj) {
	return obj.links.length;
}

function getLinkLength(obj) {
	friend = obj
	return getNextLinkIndex (friend)
}

function addFriend(name){
	var Links = new Array ();
	var nextIndex = NETWORK.length;
	var n = new Friend(nextIndex, name ,Links);
 	NETWORK[nextIndex] = n
 	return n
}

function addLink (person,friend,weight) {
	linkIndex1 = getNextLinkIndex(person);
	linkIndex2 = getNextLinkIndex(friend);
	link = new Link(friend,weight)
	Link.i--;
	linkback = new Link(person,weight)
	person.links[linkIndex1] = link;
	friend.links[linkIndex2] = linkback;
}

function friendExplored (name,path) {
	if (path.search(name)==-1)
		return true;
	else
		return false;
}

function getLink (person,friend) {
	for (var i in person.links) {
		if (friend.id == person.links[i].friend.id) return person.links[i];
	}
}

function getWeight (person,friend) {
	return getLink(person,friend).weight
}

// discovers rates of information exchange
function objectiveFunction (path) {
	var friends = path.split(";");
	var weighting = 0;
	for (var i = 0, j =1;j<friends.length; i++, j++){
		weighting = weighting + getWeight(getFriend(friends[i]),getFriend(friends[j]));
	}
	return Math.round(weighting*100)/100;
}


function createOccurranceMatrix (){
	for (i=0;i<NETWORK.length; i++) {//making it go down for amount of friends
		name=NETWORK[i].getName();
		link=NETWORK[i].links[0].id;
		links=new Array();
		for(j=0;j<getLinkIndex();j++){
			links[j]= 0;
		}
		for(l=0;l<NETWORK[i].links.length;l++){
			links[NETWORK[i].links[l].id-1]=1; //then this part is putting the 1 or 0 against the links
		}
		MATRIX[name]=links;
	}	
}

function dump(obj) {
    var out = '';
	var pre = document.createElement('pre');
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
	pre.innerHTML = out;
    document.body.appendChild(pre)
}


function findPaths (s,t,nol,path,side,trace) {
	if (trace) document.write("S="+s.name+" T="+t.name+" L="+nol+" "+side+" P="+path+"<br>");

	if (nol == 0) { // all links for friend explored no path found
		if (trace) 
			document.write("all links for " + s.name + " explored<br>");
			return;
	}
	else {
		if (s.id == t.id) { // goal achieved routing path to target found
			var weighting = objectiveFunction(path);
			if (PATHS == null)
				PATHS = path + ";" + weighting;
			else
				PATHS = PATHS + ":" + path + ";" + weighting;
			if (trace) document.write ("<p align=left>target and source match path=" + path + " weighting=" + weighting + "</p>");
		}
		else {
			if ((getLinkLength(s)==1) & (side!="root")){ 	// no match blind alley
				if (trace) document.write("end friend found for " + s.name + " back track <br>");
				return;
			}
			else {
				linkedFriend = s.links[nol-1].friend;
				if (!friendExplored (linkedFriend.name, path)) { 	// friend exists path already explored
					if (trace) document.write("existing path for " + linkedFriend.name + "<br>");
						findPaths(s ,t,nol-1,path,"rhs",trace)
					}
				else { // an unexplored path
					if (trace) document.write("unexplored path for " + linkedFriend.name + "<br>");
						findPaths(linkedFriend,t,getLinkLength(linkedFriend),path + ";" + linkedFriend.name,"lhs",trace)
					findPaths(s ,t,nol-1,path,"rhs",trace)
				}
			}
		}
	}
}




function traverseNetwork (source,target,trace) {
	var sourceObj = getFriend(source);
	var targetObj = getFriend(target);
	PATHS = null;
	findPaths(sourceObj,targetObj,getLinkLength(sourceObj),sourceObj.name+"","root",trace);
}

window.alert("FOAF Ultities Loaded");