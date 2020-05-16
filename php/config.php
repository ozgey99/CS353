<?php
session_start();
$host = "eu-cdbr-west-03.cleardb.net";
$username = "b81143f8d33a56";
$pw = "6b5fc2c7";
$db = "heroku_31ef56b49cb5553";

$cn = mysqli_connect($host, $username, $pw, $db);

if (!$cn) {
    die("Error while connecting: " . mysqli_connect_error());
}

