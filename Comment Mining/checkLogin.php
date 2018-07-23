<?PHP
// save user entries to variable
$tbUser = $_POST['user'];
$tbPass = $_POST['pass'];
setcookie('username', $tbUser);

$db=sqlite_open("tables.db"); 
	$userQuery = sqlite_query($db,"SELECT * from logins WHERE username = '$tbUser'");
	
	//getting userID and username
	while($row = sqlite_fetch_array($userQuery,SQLITE_ASSOC)){
		$dbUser = $row['username'];
		$dbPass = $row['password'];
	}
//redirects the user if they fail to enter any info in none or only one of the text boxes 

if($tbUser==NULL || $tbPass==NULL){
	
	$text = ("You have left either the username or password entry empty!");
	$header = ('index.php');
	header ('location: info.php'); 
}
else{
	//check to see if user entry and database user and pass match
	if(($tbUser == $dbUser) && ($tbPass == $dbPass)){
		
	if($tbUser == "admin"){
	$text = ("You have successfully logged in ".$tbUser."!");
	$header = ('adminChoice.php');
	header ('location: info.php');
	}
	else{
	$text = ("You have successfully logged in ".$tbUser."!");
	$header = ('choice.php');
	header ('location: info.php');
	}
	}
	else{
	//go back to login
	$text = ("You have incorrectly entered either the username or password, please try again.");
	$header = ('index.php');
	header ('location: info.php');
	}

	
}

setcookie('text', $text);	
setcookie('header', $header);
sqlite_close($db);



?>