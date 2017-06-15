<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "admin";
$Salt = "Pr0j3ct@P3rt4ma!";
$conn = mysqli_connect($servername, $username, $password, $dbase);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//Function
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>