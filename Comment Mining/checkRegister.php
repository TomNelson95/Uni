<?PHP

//save user entries
$tbUserReg = $_POST['userReg'];
$tbPassReg = $_POST['passReg'];
$tempUser = strtolower($tbUserReg);

$db=sqlite_open("tables.db");//open database to add to it

//check to stop duplicate usernames
$userCheck = sqlite_query($db,"SELECT * FROM logins WHERE lower(username) = '$tempUser'");
while($row=sqlite_fetch_array($userCheck,SQLITE_ASSOC)){
	$lwrUser = $row['username'];
}


//redirects the user if they fail to enter any info in none or only one of the text boxes 
if(empty($tbUserReg) || empty($tbPassReg)){
	$text = ("You have left either the username or password entry empty!");
$header = ('register.php');
header ('location: info.php');
	
	
}
else if (strlen($tbUserReg)> 10 || strlen($tbPassReg)> 10){
	
$text = ("You have exceeded the 10 charecter restriction for the username or password!");
$header = ('register.php');
header ('location: info.php');
}
else if($tempUser = $lwrUser){
	//stop the same username being used
$text = ("The username you have entered is already in use!");
$header = ('register.php');
header ('location: info.php');
	
}
else{
	//inserts info then takes user to login page
sqlite_query($db,"INSERT INTO logins (username, password) VALUES ('$tbUserReg', '$tbPassReg')");
$text = ("You have successfully registered as ".$tbUserReg."!");
$header = ('index.php');
header ('location: info.php');
}



setcookie('text', $text);	
setcookie('header', $header);
sqlite_close($db);


?>