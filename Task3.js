function createTable () {	

	document.write("<title> Linkage Table</title>");
	// Run function createOccurranceMatrix() to create occurrance matrix from graph. The matrix is stored in a global variable MATRIX.
	createOccurranceMatrix();
	
	//Add all links and save to new array
	var linkCount = new Array();
	var i =0;
	for (obj in MATRIX){
		
			linkCount[i] = 0;
			
			for(j=0;j<MATRIX[obj].length;j++){
				if(MATRIX[obj][j] == 1){
					linkCount[i] = linkCount[i] + 1;
				}
				
			}
			
			i = i + 1;

	}
	
	//find index of largest element in array
	
	var largestNum = linkCount[0];
	var index =0;
	for (x = 0;x<linkCount.length;x++){
		if(linkCount[x]>largestNum){
			largestNum = linkCount[x];
			index = x;
			
		}
		
	}
	
	//print table
	document.write("<table border=1 width=75% height=50>");
	document.write("<TD align=right>","Node:","</TD>");
	//Change colour of name cell to red
	var names =new Array();
	var f = 0;
	for (obj in MATRIX){
		
		names[f] = obj;
		
		f = f +1;
		
	}
	
	for(obj in MATRIX){
		//names[index] = obj;
		//var t = 0;

		
		
		//t = t+1;
		if(obj == names[index]){
			document.write("<TD align=center bgcolor=#FF0000>",obj,"</TD>");
		}
		
	else{
		
		document.write("<TD align=center>",obj,"</TD>");
	}
	}
	document.write("<TR><TD align=right>","Link:","</TD>")
	
	for(l=0;l<linkCount.length;l++){
		//change colour of cell highest value cell to red
	if(linkCount[l] == linkCount[index]){
			document.write("<TD align=center bgcolor=#FF0000>",linkCount[l],"</TD>")
	}
	else{
		document.write("<TD align=center>",linkCount[l],"</TD>")
	}
		}
	document.write("</TR>");
	document.write("</Table>");
	//dump the occurrence matrix to reveal it's structure
	//dump(MATRIX);

}