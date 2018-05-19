<?php
$config = parse_ini_file("../../moj_config.ini.php");

$servername = "localhost";
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$name = test_input($_POST['name']);
$json = json_decode($_POST['jsondata']);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$conn->query("DELETE FROM rocnikac WHERE username='$name'");
$note = "";
foreach($json as &$val){

   $sql = "INSERT INTO rocnikac (username, day, time, type, note) VALUES ('$name', '$val->day', '$val->time', '$val->type',
      '$val->note')";
   $result = $conn->query($sql);
}

$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?> 
