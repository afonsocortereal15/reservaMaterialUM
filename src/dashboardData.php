<?php
include("../inc/connect.inc");

$sql = "SELECT * FROM materialtype";
$result = mysqli_query($conn, $sql);
$typeCount = mysqli_num_rows($result);

$sql = "SELECT * FROM materials";
$result = mysqli_query($conn, $sql);
$materialsCount = mysqli_num_rows($result);

$sql = "SELECT * FROM reservations";
$result = mysqli_query($conn, $sql);
$reservationsCount = mysqli_num_rows($result);

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$usersCount = mysqli_num_rows($result);
