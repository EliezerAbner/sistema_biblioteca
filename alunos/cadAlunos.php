<?php

/*
 - falta:
    *verificar inserção duplicada;
    *visual;
*/

require_once '../conexao.php';

if (isset($_POST["btnCadastrar"]))
{
    if (verificaVazios())
    {
        $nome = $_POST["txtNome"];
        $dataNascimento = $_POST["txtDataNascimento"];
        $cpf = $_POST["txtCpf"];
        $rg = $_POST["txtRg"];
        $celular = $_POST["txtCelular"];
        $email = $_POST["txtEmail"];
        $cep = $_POST["txtCep"];
        $rua = $_POST["txtRua"];
        $numero = $_POST["txtNum"];
        $bairro = $_POST["txtBairro"];
        $cidade = $_POST["txtCidade"];

        if(verificaNomeAluno($nome))
        {
            ?>
            <script>
                window.location.href = "../index.html";
                var msg = <?php echo json_encode("Erro!") ?>;
                alert(msg);
            </script>
            <?php

            /*
                Pro futuro:
                Mostrar uma janela onde o usuário verá o erro e poderá escolher se vai atualizar os dados ou cancelar a ação
            */
        }
        else
        {
            insert("INSERT INTO bairro (nomeBairro) VALUES ('{$bairro}')", "bairro", "nomeBairro", $bairro);
            $bairroId = obterId("SELECT max(bairroId) AS bairroId FROM bairro", "bairroId");

            insert("INSERT INTO cidade (nomeCidade) VALUES ('{$cidade}')");
            $cidadeId = obterId("SELECT max(cidadeId) AS cidadeId FROM cidade", "cidadeId");

            insert("INSERT INTO aluno (nomeAluno, cpf, rg, celular, dataNascimento, email, cep, rua, numero, bairroId, cidadeId) VALUES ('{$nome}', '{$cpf}', '{$rg}', '{$celular}', '{$dataNascimento}', '{$email}', '{$cep}', '{$rua}', '{$numero}', '{$bairroId}', '{$cidadeId}')");

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

function insert($sql, $tabela, $coluna, $dado)
{  
    if(verificaDuplicados($tabela, $coluna, $dado))
    {
        //
    }
    else
    {
        $con = $_SESSION["conexao"];
        $insert = mysqli_query($con, $sql);

        if (!mysqli_affected_rows($con) == 1)
        {
            mensagem("Erro ao cadastrar o aluno");
        }
    }
}

function obterId($sql, $id)
{
    $con = $_SESSION["conexao"];
    
    $select = mysqli_query($con, $sql);

    if (mysqli_num_rows($select) > 0 )
    {
        while ($result  = mysqli_fetch_assoc($select))
        {
            $idObtido = $result[$id];
        } 
    }

    return $idObtido;
}

function verificaDuplicados($tabela, $coluna, $dado)
{
    $con = $_SESSION["conexao"];
    $sql = "SELECT * FROM '{$tabela}' WHERE '{$coluna}'='{$dado}'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function verificaVazios()
{
    if ($_POST["txtNome"] == "" || 
    $_POST["txtDataNascimento"] == "" || 
    $_POST["txtCpf"] == "" || 
    $_POST["txtRg"] == "" || 
    $_POST["txtCelular"] == "" || 
    $_POST["txtEmail"] == "" || 
    $_POST["txtCep"] == "" || 
    $_POST["txtRua"] == "" || 
    $_POST["txtNum"] == "" || 
    $_POST["txtBairro"] == "" || 
    $_POST["txtCidade"] == "")
    {
        mensagem("Preencha os campos");
    }
    else
    {
        return true;
    }
}

function verificaNomeAluno($nome)
{
    $con = $_SESSION["conexao"];
    $sql = "SELECT * FROM aluno WHERE nomeAluno='{$nome}'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function mensagem($msg)
{
    ?>
    <script>
        window.location.href = "cadAlunos.html";
        var msg = <?php echo json_encode($msg) ?>;
        alert(msg);
    </script>
    <?php
}

?>