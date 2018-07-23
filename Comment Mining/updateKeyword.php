<html>
<body>

<p style="font-family:verdana">Please select the keyword you would like to update from the drop down list below, and then enter the new rating in the textbox you would like to use!</p>
<table>
<form action="checkUpdateKeyword.php" method="POST">
<tr>
<td><p style="font-family:verdana">Keyword:</p></td>
<td>
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
</td>
</tr>
<tr>
<td><p style="font-family:verdana">Keyword Rating:</p></td><td><input type="integer" name="keywordRating"/></td>
</tr>
</table>
<table width=35% height=30>
<tr><td align="center">
<input type="submit" value="Update keyword" style="width:120px"/>
</form>
</td></tr>
<tr><td align="center">
<form action="keywords.php">
<input type="submit" value="Back" style="width:120px"/>
</form>
</td></tr>
</table>



</body>
</html>