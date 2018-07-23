<html>
<body>

<p style="font-family:verdana">Please add the keyword and the rating for it below</p>
<table>
<form action="checkAddKeyword.php" method="POST">
<tr><td><p style="font-family:verdana">Keyword:</p></td><td><input type="text" name="keyword" required/></td></tr>
<tr><td><p style="font-family:verdana">Keyword Rating:</p></td><td><input type="integer" name="keywordRating" required/></td></tr>
</table>
<table width=35% height=20>
<tr>

<td align="center">
<input type="submit" value="Add keyword" style="width:100px"/>
</form>
</td></tr>
<tr><td align="center">


<form action="keywords.php">
<input type="submit" value="Back" style="width:100px"/>
</form>
</td></tr>
</table>



</body>
</html>