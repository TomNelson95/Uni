<?PHP

$deleteKeyword = $_POST['keywordChoice'];

$db=sqlite_open("tables.db");

$keywordQuery=sqlite_query($db,"SELECT * from keywords WHERE keyword = '$deleteKeyword'");
while($row=sqlite_fetch_array($keywordQuery,SQLITE_ASSOC)){
	$previousRating = $row['ratingValue'];
}

//deletes keyword
sqlite_query($db,"DELETE from keywords WHERE keyword = '$deleteKeyword'");

$commentQuery=sqlite_query($db,"SELECT * from comments");

$commentNo = 1;
while($row=sqlite_fetch_array($commentQuery,SQLITE_ASSOC)){

$lowerCom = strtolower($row['comment']);
$commentRating = $row['rating'];
if(strpos($lowerCom, $deleteKeyword) !== false){
	$rating = $commentRating - $previousRating;
	sqlite_query($db,"UPDATE comments SET rating='$rating' WHERE commentID = '$commentNo'");
}
$commentNo = $commentNo + 1;
}

//need to update topics tables
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

$text = ("You have successfully deleted the keyword ".$deleteKeyword.".");
$header = ('deleteKeyword.php');
header ('location: info.php');

setcookie('text', $text);	
setcookie('header', $header);


sqlite_close($db);

//change to a redirect page
header ('location: info.php');

?>