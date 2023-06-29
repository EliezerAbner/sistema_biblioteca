<?php

require '../crud.php';

if(isset($_POST["btnSubmit"]))
{
    if(varificaVazios())
    {
        $nomeAluno = $_POST["txtAluno"];
        $nomeLivro = $_POST["txtLivro"];
        $dataEntrega = $_POST["txtDataEntrega"];

        $qtdeDisponivel = obterId("SELECT * FROM exemplarlivro", "numeroExemplar");

        if ($qtdeDisponivel > 0)
        {
            $nomeAluno = obterId("SELECT * FROM aluno WHERE nomeAluno='{$nomeAluno}'", "alunoId");
            $nomeLivro = obterId("SELECT * FROM livro WHERE nomeLivro='{$nomeLivro}'", "livroId");
            $exemplarLivro = obterId("SELECT * FROM exemplarlivro", "exemplarLivroId");

            insertEmprestimo($exemplarLivro, $nomeAluno, $dataEntrega);
            atualizar("UPDATE exemplarlivro SET numeroExemplar = numeroExemplar - 1 WHERE exemplarLivroId= $exemplarLivro");

            mensagem("Empréstimo realizado com sucesso!");
        }
        else
        {
            mensagem("Livro não disponível");
        }
    }
}

function varificaVazios()
{
    if($_POST["txtLivro"] == "" || $_POST["txtAluno"] == "" || $_POST["txtDataEntrega"] == "")
    {
        ?>
        <script>
            window.location.href = "cadLivros.html";
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