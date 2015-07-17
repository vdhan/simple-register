<?php
session_start();
$salt = uniqid(rand(), true);

$s = $_FILES["file"]["name"];
$t = explode(" ", $s);
$p = implode("_", $t);

$fdir = hash('sha512', $salt . $s);
$dir = "files/" . $fdir;
mkdir($dir, 0777);
$dir .= "/" . $p;
move_uploaded_file($_FILES["file"]["tmp_name"], $dir);

$server = "";
$user = "";
$pass = "";

$conn = new mysqli($server, $user, $pass);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$id = $_SESSION['id'];
$sql = "
update test.user
set image = '{$dir}'
where id = {$id}
";

if ($conn->query($sql) === TRUE) {
	$_SESSION['image'] = $dir;
	echo $dir;
} else {
	echo "Error: " . $conn->error;
}
$conn->close();
?>
