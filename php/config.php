<?php
session_start();
$host = "192.168.1.34:3306";
$username = "root";
$pw = "Ozge123";
$db = "cs353";

$cn = mysqli_connect($host, $username, $pw, $db);

if (!$cn) {
    die("Error while connecting: " . mysqli_connect_error());
}

