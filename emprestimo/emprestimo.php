<?php

require '../crud.php';

if(isset($_POST["btnSubmit"]))
{
    if(varificaVazios())
    {
        $nomeAluno = $_POST["txtAluno"];
        $nomeLivro = $_POST["txtLivro"];
        $dataEntrega = $_POST["txtDataEntrega"];

        $nomeAluno = obterId("SELECT * FROM aluno WHERE nomeAluno='{$nomeAluno}'", "alunoId");
        $nomeLivro = obterId("SELECT * FROM livro WHERE nomeLivro='{$nomeLivro}'", "livroId");
        $exemplarLivro = obterId("SELECT * FROM exemplarlivro", "exemplarLivroId");

        insertEmprestimo($exemplarLivro, $nomeAluno, $dataEntrega);

        ?>
            <script>
                window.location.href = "../index.html";
                var msg = <?php echo json_encode("Empréstimo concluido com sucesso!") ?>;
                alert(msg);
            </script>
            <?php
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