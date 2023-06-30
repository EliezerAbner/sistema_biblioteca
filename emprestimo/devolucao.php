<?php

if (isset($_POST["btnDevolver"]))
{
    $codLivro = $_POST["txtCodLivro"];
    $nomeAluno = $_POST["txtNomeAluno"];

    $idEmprestimo = obterId("SELECT * FROM emprestimolivro WHERE ");
}

?>