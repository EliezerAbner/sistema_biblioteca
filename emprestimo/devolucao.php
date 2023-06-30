<?php

if (isset($_POST["btnDevolver"]))
{
    $codLivro = $_POST["txtCodLivro"];
    $nomeAluno = $_POST["txtNomeAluno"];

    $alunoId = obterId("SELECT * FROM aluno WHERE nomeAluno={$nomeAluno}","alunoId");
    $codLivro = obterId("SELECT * FROM exemplarLivro WHERE numeroExemplar={$codLivro}", "exemplarLivroId");

    devolucaoEmprestimo($alunoId, $codLivro);
}

?>