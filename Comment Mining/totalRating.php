<?PHP
$comment = "rubbish worst";
$rating = 0;



//makes it case insensitive by making it all lower
$lowerCom = strtolower($comment);


$db=sqlite_open("tables.db");
$result=sqlite_query($db,"SELECT * from keywords");


//goes through each row in DB trying to find each string
//then adds to the rating value if string is found
while($row=sqlite_fetch_array($result,SQLITE_ASSOC))
{
	if(strpos($lowerCom, $row['keyword']) !== false){
	$rating = $rating + $row['ratingValue'];
}
}
sqlite_close($db);
echo ($rating);





?>
