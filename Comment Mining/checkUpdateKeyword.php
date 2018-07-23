<?PHP
$db=sqlite_open("tables.db");

$keyword = $_POST['keywordChoice'];
$updateRating = $_POST['keywordRating'];

$keywordQuery=sqlite_query($db,"SELECT * from keywords WHERE keyword = '$keyword'");
while($row=sqlite_fetch_array($keywordQuery,SQLITE_ASSOC)){
	$previousRating = $row['ratingValue'];
}







//check entry is number
if($updateRating > 0 || $updateRating < 0)
	{//if good
sqlite_query($db,"UPDATE keywords SET ratingValue='$updateRating' WHERE keyword = '$keyword'");
	}
else{//if bad sends user back to update page
	$text = ("You have incorrectly entered the new keyword rating value.");
	$header = ('updateKeyword.php');
	header ('location: info.php');
}

//update all comments and topics with update

//working
$commentQuery=sqlite_query($db,"SELECT * from comments");

$commentNo = 1;
while($row=sqlite_fetch_array($commentQuery,SQLITE_ASSOC)){

$lowerCom = strtolower($row['comment']);
$commentRating = $row['rating'];
if(strpos($lowerCom, $keyword) !== false){
	$rating = $commentRating - $previousRating + $updateRating;
	sqlite_query($db,"UPDATE comments SET rating='$rating' WHERE commentID = '$commentNo'");
}
$commentNo = $commentNo + 1;
}



//topic update
$topics = array();
$topicNo = 0;
$topicQuery=sqlite_query($db,"SELECT * from topics");
$commentsQuery=sqlite_query($db,"SELECT * from comments");

while($row=sqlite_fetch_array($topicQuery,SQLITE_ASSOC))
{
$topics[$topicNo] = $row['topic'];//get topics for comparison
$topicNo = $topicNo + 1;
}
$comsTopic = array() ;
$comsRating = array();
$comsNo = 0;
while($row=sqlite_fetch_array($commentsQuery,SQLITE_ASSOC)){
$comsTopic[$comsNo] = $row['topic'];
$comsRating[$comsNo] = $row['rating'];
$comsNo = $comsNo + 1;
}
$topicRating = array();
for($x = 0; $x <= $topicNo;$x++){//go through topics
	for($y = 0;$y <= $comsNo;$y++){
		if($topics[$x] == $comsTopic[$y]){
		$topicRating[$x] = $topicRating[$x] + $comsRating[$y];
		}
		
	}
	
	
	
}

for($x = 0; $x <= $topicNo;$x++){
	if($topicRating[$x] < 0 || $topicRating[$x] > 0 ){
	}
	else{
			$topicRating[$x] = 0;
	}
sqlite_query($db,"UPDATE topics SET totalRating='$topicRating[$x]' WHERE topic = '$topics[$x]'");
}		


$text = ("You have successfully updated the keyword ".$keyword." with a new rating of ".$updateRating.".");
$header = ('updateKeyword.php');
header ('location: info.php');

setcookie('text', $text);	
setcookie('header', $header);
sqlite_close($db);

?>