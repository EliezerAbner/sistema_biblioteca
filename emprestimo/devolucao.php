<?php

if (isset($_POST["btnDevolver"]))
{
    $nomeLivro = $_POST["txtNomeLivro"];
    $nomeAluno = $_POST["txtNomeAluno"];

    $idEmprestimo = obterId("SELECT * FROM emprestimolivro WHERE ");
}

?>