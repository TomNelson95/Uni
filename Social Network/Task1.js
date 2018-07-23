function dumpNetwork() {
	for (obj in NETWORK){
		document.write(NETWORK[obj].name)
		for (prop in NETWORK[obj]){
			document.write("<p>"+prop+": "+ NETWORK[obj][prop] +"</p>");
		}
		
	}
 }