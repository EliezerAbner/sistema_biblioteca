<?php

require_once '../conexao.php';
require '../crud.php';

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
            $bairroId = insert("INSERT INTO bairro (nomeBairro) VALUES ('{$bairro}')", "bairro", "nomeBairro", $bairro, "SELECT max(bairroId) AS bairroId FROM bairro", "bairroId");

            $cidadeId = insert("INSERT INTO cidade (nomeCidade) VALUES ('{$cidade}')", "cidade", "nomeCidade", $cidade, "SELECT max(cidadeId) AS cidadeId FROM cidade", "cidadeId");

            $insert = insert("INSERT INTO aluno (nomeAluno, cpf, rg, celular, dataNascimento, email, cep, rua, numero, bairroId, cidadeId) VALUES ('{$nome}', '{$cpf}', '{$rg}', '{$celular}', '{$dataNascimento}', '{$email}', '{$cep}', '{$rua}', '{$numero}', '{$bairroId}', '{$cidadeId}')", "aluno", "nomeAluno", $nome, "SELECT max(alunoId) AS alunoId FROM aluno", "alunoId");

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
else if (isset($_POST["btnAtualizar"]))
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

        $bairroId = obterId("SELECT * FROM bairro WHERE nomeBairro = '{$bairro}'","bairroId");
        atualizar("UPDATE `bairro` SET nomeBairro = '{$bairro}' WHERE bairroId = '{$bairroId}'");

        $cidadeId = obterId("SELECT * FROM cidade WHERE nomeCidade = '{$cidade}'","cidadeId"); 
        atualizar("UPDATE `cidade` SET nomeCidade = '{$cidade}' WHERE cidadeId = '{$cidadeId}'"); 

        $alunoId = obterId("SELECT * FROM aluno WHERE nomeAluno = '{$nome}'","alunoId");
        atualizar("UPDATE `aluno` SET nomeAluno='{$nome}', cpf='{$cpf}', rg='{$rg}', celular='{$celular}', dataNascimento='{$dataNascimento}', email='{$email}', cep='{$cep}', rua='{$rua}', numero='{$numero}', bairroId='{$bairroId}', cidadeId='{$cidadeId}' WHERE alunoId='{$alunoId}'");

        ?>
        <script>
            window.location.href = "../index.html";
            var msg = <?php echo json_encode("Aluno atualizado com sucesso!") ?>;
            alert(msg);
        </script>
        <?php
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
        ?>
        <script>
            window.location.href = "cadAlunos.html";
            var msg = <?php echo json_encode("Preencha os dados") ?>;
            alert(msg);
        </script>
        <?php
    }
    else
    {
        return true;
    }
}