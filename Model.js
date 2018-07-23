/*
	Author: T.Nelson 2017
*/

//nodes
var Abdul = addFriend ("Abdul");
var Bob = addFriend ("Bob");
var Clare = addFriend ("Clare");
var Dave = addFriend ("Dave");
var Earl = addFriend ("Earl");
var Fay = addFriend ("Fay");
var Gill = addFriend ("Gill");
var Hugh = addFriend ("Hugh");
var Iris = addFriend ("Iris");
var Jane = addFriend ("Jane");

//links
addLink(Clare,Bob,80); 
addLink(Clare,Abdul,14);
addLink(Clare,Hugh,7);
addLink(Clare,Gill,30);
addLink(Clare,Fay,2);
addLink(Clare,Dave,4);
addLink(Bob,Dave,7);
addLink(Dave,Earl,10);
addLink(Earl,Fay,53);
addLink(Fay,Gill,12);
addLink(Gill,Iris,20);
addLink(Iris,Hugh,5);
addLink(Iris,Jane,3);

window.alert("model loaded");