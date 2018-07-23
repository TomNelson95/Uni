
function createTable () {
	document.write("<title> FOAF Occurrence Table</title>");
	
	// Run function createOccurranceMatrix() to create occurrance matrix from graph. The matrix is stored in a gloabl variable MATRIX.
	createOccurranceMatrix();
	
	
		document.write("<table border=1 width=100% height=600>");// possible automate the amount of column headers
		document.write("<TH>Nodes</TH><TH>Link 1</TH><TH>Link 2</TH><TH>Link 3</TH><TH>Link 4</TH><TH>Link 5</TH><TH>Link 6</TH><TH>Link 7</TH><TH>Link 8</TH><TH>Link 9</TH><TH>Link 10</TH><TH>Link 11</TH><TH>Link 12</TH><TH>Link 13</TH>");
		
		
		//enters names
		for (obj in MATRIX){
		document.write("<TR><TD align=right font-Weight=normal>",obj + ":","</TD>");
		
		//enters link values
		for(j=0;j<MATRIX[obj].length;j++){
			document.write("<TD align=center>",MATRIX[obj][j],"</TD>");
		}
		document.write("</TR>");
		}
		document.write("</Table>");
 }
 