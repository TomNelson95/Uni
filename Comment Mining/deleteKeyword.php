<html>
<body>
<form action="checkDeleteKeyword.php" method="POST">
<p style="font-family:verdana">Please select the keyword you would like to delete from the drop down menu below, all corresponding comment and topic ratings will reflect any changes made!</p>
<table><tr><td>
<select name="keywordChoice">
<?PHP
$db=sqlite_open("tables.db");

$keywordresult=sqlite_query($db,"SELECT * from keywords");

while($row=sqlite_fetch_array($keywordresult,SQLITE_ASSOC)){
	echo('<option value="'.$row['keyword'].'">'.$row['keyword'].'</option>');
}
sqlite_close($db);

?>
</select>
</td><td>
<input type="submit" value="Delete keyword" style="width:120px"/>
</form>
</td></tr>
<tr><td></td><td>
<form action="keywords.php">
<input type="submit" value="Back" style="width:120px"/>
</form>
</td></tr>
</table>
</body>
</html>