<?php
require_once '../conexao.php';

$query = "SELECT * FROM emprestimolivro";
$con = $_SESSION["conexao"];

$select = mysqli_query($con, $query);

if (mysqli_num_rows($select) > 0 )
{
    while ($result  = mysqli_fetch_assoc($select))
    {
        $
    }