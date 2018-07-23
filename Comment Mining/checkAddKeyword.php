<?PHP
$keyword = $_POST['keyword'];
$keywordRating = $_POST['keywordRating'];
$tempKeyword = strtolower($keyword);

$db=sqlite_open("tables.db");

//check to stop duplicate keywords
$keywordCheck = sqlite_query($db,"SELECT * FROM keywords WHERE lower(keyword) = '$tempKeyword'");
while($row=sqlite_fetch_array($keywordCheck,SQLITE_ASSOC)){
	$lwrKeyword = $row['keyword'];
}


if(empty($keyword) || empty($keywordRating)){
	$text = ("You have not entered a value for either the keyword or the rating!");
	$header = ('addKeyword.php');
	header ('location: info.php');
}
else if (strlen($keyword)> 10){
	
	$text = ("The keyword must be below 10 charecters!");
	$header = ('addKeyword.php');
	header ('location: info.php');
}
else if($tempKeyword = $lwrKeyword){
	$text = ("The keyword you have entered is already being used!");
	$header = ('addKeyword.php');
	header ('location: info.php');
}

else if($keywordRating > 0 || $keywordRating < 0)
	{
	//inserts info then takes user to login page
sqlite_query($db,"INSERT INTO keywords (keyword, ratingValue) VALUES ('$keyword', '$keywordRating')");
$text = ("You have successfully added the keyword ".$keyword." with the rating of ".$keywordRating.".");
$header = ('addKeyword.php');
	}
	else{$text = ("You have incorrectly entered the keyword and/or rating!");
	$header = ('addKeyword.php');
	header ('location: info.php');
	}
	
	
//comments
$commentQuery=sqlite_query($db,"SELECT * from comments");
$commentNo = 1;
while($row=sqlite_fetch_array($commentQuery,SQLITE_ASSOC)){

$lowerCom = strtolower($row['comment']);
$commentRating = $row['rating'];
if(strpos($lowerCom, strtolower($keyword)) !== false){
	$rating = $commentRating + $keywordRating;
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


header ('location: info.php');

setcookie('text', $text);	
setcookie('header', $header);
sqlite_close($db);
?>