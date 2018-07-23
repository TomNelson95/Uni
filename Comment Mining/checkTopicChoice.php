<?PHP

$topic = $_POST['topicChoice'];
$tempTopic = $topic;


if(empty($topic)){
	header ('location: chooseTopic.php'); 
}
else{
	setcookie('topicChoice',$_POST['topicChoice']);
	
	$username = $_COOKIE['username'];
$comment = $_POST['comment'];
$date = date('d-m-y');
$time = date('G:i');
$topic = $_COOKIE['topicChoice'];//change to selecting

$rating = 0;

//check if comment is empty
if($comment == NULL){
	header ('location: addComs.php'); 
}



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

//Insert comment
sqlite_query($db,"INSERT INTO comments (username, topic, comment, commentDate, commentTime, rating) VALUES ('$username', '$tempTopic', '$comment','$date','$time','$rating')");


//add rating for comment to the topic total
$topicQuery = sqlite_query($db,"SELECT totalRating FROM topics WHERE topic = '$tempTopic'");

while($row=sqlite_fetch_array($topicQuery,SQLITE_ASSOC)){
	$newTopicValue = $row[totalRating] + $rating;
}

sqlite_query($db,"UPDATE topics SET totalRating = '$newTopicValue' WHERE topic = '$tempTopic'");
sqlite_close($db);

$text = ("You have successfully added a comment for the topic ".$tempTopic.".");
	$header = ('choice.php');
	
setcookie('text', $text);	
setcookie('header', $header);

header ('location: info.php');
}


?>