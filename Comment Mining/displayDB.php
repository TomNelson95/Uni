<html>

<?php

$db=sqlite_open("tables.db");


echo "<table border=1>";
//NOte the use of SQLITE_BOTH
$result=sqlite_query($db,"SELECT * from logins");

echo "USERS";
while($row=sqlite_fetch_array($result,SQLITE_ASSOC))
{
	echo "<tr>\n";
    echo "<td>" . $row['username'] . "</td>\n"; 
	echo "<td>" . $row['password'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";


echo "<br/>";

echo "<table border=1>";
$keywordresult=sqlite_query($db,"SELECT * from keywords");
echo "KEYWORDS";
while($row=sqlite_fetch_array($keywordresult,SQLITE_ASSOC))
{
	echo "<tr>\n";
    echo "<td>" . $row['keyword'] . "</td>\n"; 
	echo "<td>" . $row['ratingValue'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";
echo "<br/>";

echo "<table border=1>";
$commentresult=sqlite_query($db,"SELECT * from comments");
echo "COMMENTS";
while($row=sqlite_fetch_array($commentresult,SQLITE_ASSOC))
{
	echo "<tr>\n";
    echo "<td>" . $row['username'] . "</td>\n"; 
	echo "<td>" . $row['topic'] . "</td>\n"; 
	echo "<td>" . $row['comment'] . "</td>\n"; 
	echo "<td>" . $row['commentDate'] . "</td>\n"; 
	echo "<td>" . $row['commentTime'] . "</td>\n"; 
	echo "<td>" . $row['rating'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";


echo "<br/>";

echo "<table border=1>";
$topicresult=sqlite_query($db,"SELECT * from topics");
echo "TOPICS";
while($row=sqlite_fetch_array($topicresult,SQLITE_ASSOC))
{
	echo "<tr>\n";
	echo "<td>" . $row['username'] . "</td>\n"; 
    echo "<td>" . $row['topic'] . "</td>\n"; 
	echo "<td>" . $row['totalRating'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";





sqlite_close($db);





?>




</html>