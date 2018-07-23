<html>
<body>
<form action="checkTopicChoice.php" method="POST">
<p style="font-family:verdana">Choose the topic you would like to comment on by using the drop down menu and then add your comment in the textbox.</p>
<p style="font-family:verdana">Select Topic: <select name="topicChoice"></p>
<?PHP
$db=sqlite_open("tables.db");

$topicresult=sqlite_query($db,"SELECT * from topics");

while($row=sqlite_fetch_array($topicresult,SQLITE_ASSOC)){
	echo('<option value="'.$row['topic'].'">'.$row['topic'].'</option>');
}
sqlite_close($db);

?>
</select>

<br>

<p><input type="text" name="comment" required/></td></tr>

<input type="submit" value="Add comment" style="width:100px"/>
</form>
<form action="choice.php">
<input type="submit" value="Back" style="width:100px"/>
</form>
</body>
</html>