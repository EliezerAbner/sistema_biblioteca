<?php

require_once("../conexao.php");

if(isset($_POST["btnCadastrar"]))
{
    if(verificaVazios())
    {
        $nomeAluno = $_POST["txtNome"];
        $cpf = $_POST["txtCpf"];
        $rg = $_POST["txtRg"];

        $sql = "INSERT INTO aluno(nomeAluno, cpf, rg) VALUES ('{$nomeAluno}', '{$cpf}', '{$rg}')";
        
        $result = mysqli_query($conn, $sql);

        if (!mysqli_affected_rows($conn) == 1)
        {
            ?>
            <script>
                window.location.href = "cadAlunos.html";
                var msg = <?php echo json_encode("Erro ao cadastrar o cliente") ?>;
                alert(msg);
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                window.location.href = "../index.html";
                var msg = <?php echo json_encode("Aluno cadastrado com sucesso!") ?>;
                alert(msg);
            </script>
            <?php
        }
    }
}

function insert($query)
{
    $sql = $query;
    $insert = mysqli_query($conn, $sql);

    if (!mysqli_affected_rows($conn) == 1)
    {
        mensagem("Erro ao cadastrar o livro");
    }
    else
    {
        return true;
    }
}

function verificaVazios()
{
    if($_POST["txtNome"] == "" || $_POST["txtCpf"] == "" || $_POST["txtRg"] == "")
    {
        ?>
        <script>
            window.location.href = "cadAlunos.html";
            var msg = <?php echo json_encode("Preencha os campos") ?>;
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