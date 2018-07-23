<?PHP
$db=sqlite_open("tables.db");


echo "<table border=1>";
//NOte the use of SQLITE_BOTH
$result=sqlite_query($db,"SELECT * from comments");


while($row=sqlite_fetch_array($result,SQLITE_ASSOC))
{
	echo "<tr>\n";
    echo "<td>" . $row['ID'] . "</td>\n"; 
	echo "<td>" . $row['username'] . "</td>\n"; 
	echo "<td>" . $row['comment'] . "</td>\n"; 
   echo "</tr>\n";
}
echo "</table>\n";



sqlite_close($db);






?>