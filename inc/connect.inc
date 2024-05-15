<?php
$env = parse_ini_file('info.env');

$server = $env['DB_HOST'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_NAME'];

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) { 
  die("Connection failed: " . mysqli_connect_error()); 
}

?>
