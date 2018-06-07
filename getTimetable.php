<?php
$config = parse_ini_file("../../moj_config.ini.php");

$servername = "localhost";
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$realname = test_input($_POST['name']);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$name = "";
$sql = "SELECT username FROM users where realname='$realname'";
$result = $conn->query($sql);
if($r = mysqli_fetch_assoc($result)) {
   $name = $r['username'];
}

$sql = "SELECT * FROM rocnikac where username='$name'";
$result = $conn->query($sql);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
   $rows[] = $r;
}
print json_encode($rows);
$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?> 
