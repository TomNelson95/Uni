<?PHP

$username = $_COOKIE['username'];
$topic = $_POST['topic'];
$rating = 0;
$tempTopic = $topic;
//check topic has not been used before
$lowerTopic = strtolower($topic);

$db=sqlite_open("tables.db");
$topicCheck = sqlite_query($db,"SELECT topic FROM topics WHERE lower(topic) = '$lowerTopic'");
while($row=sqlite_fetch_array($topicCheck, SQLITE_ASSOC)){
	$topicResult = $row['topic'];
}

//check if empty
if(empty($topic)){
	$text = ("You have not entered a topic.");
	$header = ('addTopic.php');
	header ('location: info.php');
}
else if ($lowerTopic == $topicResult){
	//stop the same topic being added
	$text = ("The topic you have entered is already being used.");
	$header = ('addTopic.php');
	header ('location: info.php');
}
else{
	sqlite_query($db,"INSERT INTO topics (username, topic, totalRating) VALUES ('$username', '$topic', '$rating')");
	$text = ("You have added the new topic, ".$topic.".");
	$header = ('choice.php');
}

	
header ('location: info.php');
setcookie('text', $text);	
setcookie('header', $header);
sqlite_close($db);

?>