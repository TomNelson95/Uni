<html>
<body>
<table width=30% height=60>
<p style="font-family:verdana">Please enter your username and password or register if you do not have an account.</p>
<!-- Using two forms for the buttons as information will need to go to two different .php files-->
<form action="checkLogin.php" method="POST">
<tr><td><p style="font-family:verdana">Username:</p></td><td><input type="text" name="user" required/></td></tr>
<tr><td><p style="font-family:verdana">Password:</p></td><td><input type="password" name="pass" required/></td></tr>
</table>
<table width=35% height=30>
<tr><td align="center">
<input type="submit" value="Login" style="width:100px"/>
</td>
</form>
<form action="register.php" method="POST">
<td align="center">
<input type="submit" value="Register" style="width:100px"/>
</td>
</tr>
</table>
</form>
</body>
</html>