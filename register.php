<?php
$server = "";
$user = "";
$pass = "";

$name = $_POST['user'];
$password = $_POST['pass'];
$email = $_POST['email'];

$conn = new mysqli($server, $user, $pass);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "
insert into test.user (username, pass, email) VALUES ('{$name}', '{$password}', '{$email}')
";
if ($conn->query($sql) === TRUE) {
	echo "
	Created account successfully<br>
	<a href='login.html'>login</a>
	";
} else {
	echo "Error: " . $conn->error;
}
$conn->close();
?>
