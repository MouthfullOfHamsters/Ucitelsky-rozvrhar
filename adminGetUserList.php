<?php
$config = parse_ini_file("../../moj_config.ini.php");

$servername = "localhost";
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT realname FROM users WHERE NOT realname='' ORDER BY realname";
$result = $conn->query($sql);
$s = '';
while($r = mysqli_fetch_assoc($result)) {
   $s .= "<tr><td>" . $r['realname'] . "</td></tr>";
}
print $s;
$conn->close();
?> 
