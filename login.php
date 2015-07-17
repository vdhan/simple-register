<?php
$server = "";
$user = "";
$pass = "";

$name = $_GET['user'];
$password = $_GET['pass'];

$conn = new mysqli($server, $user, $pass);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "
select id, username, pass, email, image
from test.user
where username = '{$name}' and pass = '{$password}'
";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	session_start();
	$_SESSION['id'] = $row['id'];
	$_SESSION['name'] = $row['username'];
	$_SESSION['pass'] = $row['pass'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['image'] = $row['image'];
	header('Location: profile.php');
} else {
	echo "
	Pair user and password mismatch<br>
	<a href='index.html'>home</a>
	";
}
$conn->close();
?>
