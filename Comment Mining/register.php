<html>
<body>
<!--Small form for user to enter a suitable username and P/W -->
<!--Possibly use a 're-enter P/W to check entry -->
<form action="checkRegister.php" method="POST">
<p style="font-family:verdana">Please enter a suitable username and password, neither can go above 10 characters!</p>
<table width=30% height=60>
<tr><td><p style="font-family:verdana">Username:</p></td><td><input type="text" name="userReg" required/></td></tr>
<tr><td><p style="font-family:verdana">Password:</p></td><td><input type="password" name="passReg" required/></td></tr>
</table>

<table width=40% height=30 >
<tr align="center"><td>
<input type="submit" value="Register"/>
</form>
</td>



</tr>
<tr align="center">
<td>
<!--return to login -->

<form action="index.php">
<input type="submit" value="Return to login"/>
</form>
</td>
</tr>
</table>

</body>
</html>