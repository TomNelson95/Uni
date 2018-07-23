
 
function createTable() {
	document.write("<title> FOAF Network Route Finder</title>");
	//need to add two drop down lists and button for user selection
	
	
	var firstFriend = document.getElementById('firstID').value;
	var secondFriend = document.getElementById('secondID').value;
	// run the rooting algorithm to find all paths between two nodes X and V. All paths between two nodes stored in a global variable PATHS. If you wish to see the routing algorithm working change the false to true.
	traverseNetwork(firstFriend,secondFriend,false);
	
	//print global variable PATHS to reveal the structure of the delimited list
	//document.write(PATHS);
	
	//create array of paths
	var pathArray = new Array();
	pathArray = PATHS.split(':');
	
	//save numbers to array
	var maxLinks = 0; //need to know before setting 2d array so can adapt to dynamic headers
	for (i = 0; i<pathArray.length;i++){
		var tempFriendship = pathArray[i].split(';');
		if(maxLinks<tempFriendship.length-3){
			maxLinks=tempFriendship.length - 3;
		}
	}
	
	//create table including paths
	var numberArray = new Array();
	var friendship = new Array();
	
	
	
	for (i = 0; i<pathArray.length;i++){
		
	
	
		//split array
		
		var tempFriendship = pathArray[i].split(';');
		
		var arrayLength = 0;
		arrayLength = tempFriendship.length;
		//set the known values in array (beginning + end)
		friendship[i] = new Array();
		
		if(tempFriendship.length < 10){
			friendship[i][0]= "friendship " + (i+1);
			friendship[i][1]= tempFriendship[0];
			
			for(j=1;j<tempFriendship.length - 2;j++){
				friendship[i][j+1]=tempFriendship[j];
			}
			//setting empty cells
			for(g=friendship[i].length;g<maxLinks+2;g++){
				friendship[i][g]="-";
			}
			friendship[i][maxLinks +2]=tempFriendship[arrayLength-2];
			friendship[i][maxLinks+3]=tempFriendship[arrayLength-1];
		}
		else{
			//works
			for(l=0;l<10;l++){
				friendship[i][0]= "friendship "+ (i+1);
				friendship[i][l+1]= tempFriendship[l];
			}
		}
		
		numberArray[i] = friendship[i][maxLinks+3];

	}
	//find highest information exchange
	var largestNum = Math.max.apply(null, numberArray);
	var index =0;
	for (q = 0;q<numberArray.length;q++){
		if(numberArray[q]==largestNum){	
			index = q;
		}
		}
	
	//display table
	document.write("<table border=1 width=100% height=550>");
	document.write("<TD align=center valign=top>Association</TD>","<TD align=center valign=top>Person</TD>");
	
	//loop to determine the amount of friends
	for(x=0;x<maxLinks;x++){
		document.write("<TD align=center valign=top>","friends + " + (x+2),"</TD>")
	}
	document.write("<TD align=center valign=top>Friend</TD>","<TD align=center valign=top>Highest Information Exchange</TD>");
	document.write("<TR>");
			for(i = 0; i<pathArray.length;i++){
				if(i == index){
					for(s=0;s<friendship[i].length;s++){
					document.write("<TD align=center valign=top bgColor=#A9A5A4>",friendship[i][s],"</TD>");
				}
				}
				else{
			for(s=0;s<friendship[i].length;s++){
			
				document.write("<TD align=center valign=top>",friendship[i][s],"</TD>");
			}
				}
		document.write("</TR>");
			}
	document.write("</table>");

	}
