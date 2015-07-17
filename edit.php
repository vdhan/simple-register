<?php
session_start();
$server = "";
$user = "";
$pass = "";

$name = $_POST['user'];
$password = $_POST['pass'];
$email = $_POST['email'];
$id = $_SESSION['id'];

$conn = new mysqli($server, $user, $pass);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "
update test.user
set username = '{$name}', pass = '{$password}', email = '{$email}'
where id = {$id}
";

if ($conn->query($sql) === TRUE) {
	$_SESSION['name'] = $name;
	$_SESSION['pass'] = $password;
	$_SESSION['email'] = $email;
	echo "
	Update profile successfully<br>
	<a href='profile.php'>profile</a>
	";
} else {
	echo "Error: " . $conn->error;
}
$conn->close();
?>
