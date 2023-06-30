<?php

require '../crud.php';

if(isset($_POST["btnSubmit"]))
{
    if(varificaVazios())
    {
        $nomeAluno = $_POST["txtAluno"];
        $codLivro = $_POST["txtCodLivro"];
        $dataEntrega = $_POST["txtDataEntrega"];

        $nomeAluno = obterId("SELECT * FROM aluno WHERE nomeAluno='{$nomeAluno}'", "alunoId");
        $exemplarLivro = obterId("SELECT * FROM exemplarlivro WHERE numeroExemplar={$codLivro}", "exemplarLivroId");

        insertEmprestimo($exemplarLivro, $nomeAluno, $dataEntrega);

        mensagem("Empréstimo realizado com sucesso!");
    }
}

function varificaVazios()
{
    if($_POST["txtCodLivro"] == "" || $_POST["txtAluno"] == "" || $_POST["txtDataEntrega"] == "")
    {
        ?>
        <script>
            window.location.href = "emprestimo/emprestimo.html";
            var msg = <?php echo json_encode("Preencha os campos!") ?>;
            alert(msg);
        </script>
        <?php
    }
    else
    {
        return true;
    }
}
?>