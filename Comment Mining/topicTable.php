<html>
<form action="choice.php">
<input type="submit" value="Return" style="width:100px"/>
</form>
<?PHP


$db=sqlite_open("tables.db");

//using sub query to order and then take top 5
$topFiveQuery = sqlite_query($db,"SELECT * FROM (SELECT * FROM topics ORDER BY totalRating DESC) LIMIT 5");

//create table and add contents
echo "<table border=1>";
echo "<th>Topic</th>";
echo "<th>Topic Rating</th>";
while($row=sqlite_fetch_array($topFiveQuery,SQLITE_ASSOC))
{
	echo "<tr>\n";
    echo "<td align=center>" . $row['topic'] . "</td>\n"; 
	echo "<td align=center>" . $row['totalRating'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";






sqlite_close($db);
?>

</html>

