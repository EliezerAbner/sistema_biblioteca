<?php

$hostname = "localhost";
$database = "sistema_biblioteca";
$user = "root";
$password = "";

$conn = mysqli_connect($hostname, $user,  $password, $database);

if (!$conn) 
{
    die(mysqli_error());
}
else 
{
    $_SESSION["conexao"] = $conn;
}
?>