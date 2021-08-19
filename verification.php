<?php

if(isset($_GET['vkey']) && isset($_GET['username'])) {
	$vkey = $_GET['vkey'];
	$username = $_GET['username'];
	$sql =  new mysqli("localhost", "root", "Olimp110", "employels");
	     	    	if($sql->connect_error) {
			die("connetion failed: " . $sql->connect_error);
	       }
	$q = "SELECT * FROM users WHERE username='$username' AND confirmed = 0 AND vkey = '$vkey';";
	$result = mysqli_query($sql, $q);
	if($row = mysqli_fetch_row($result)) {
	$q = "UPDATE users SET confirmed = 1 WHERE username='$username' AND vkey = '$vkey';";
	$update = $sql->query($q);
	echo "Your account has been varified";
	} else {
	echo "this account haven't been verified or does not existing ";
	echo "Check your email, or ";
	echo '<a href="https://khavronin.ursse.org/signup.php">Sign Up</a>';
	}
} else {
die("something went wrong");
}

?>


<html>
<head>

</head>
<body>


</body>

</html>