<?php

require_once '../conexao.php';

function insert($insertQuery, $verificaTabela, $verificaColuna, $VerificaDado, $queryObterId, $colunaId)
{
    $idObtido = verificaDuplicados($verificaTabela, $verificaColuna, $VerificaDado, $colunaId); //retorna ID caso exista, ou false

    if($idObtido == false)
    {
        $con = $_SESSION["conexao"];
        $insert = mysqli_query($con, $insertQuery);

        if (!mysqli_affected_rows($con) == 1)
        {
            mensagem("Erro ao realizar cadastro!");
        }
        if ($queryObterId != "") 
        {
            $idObtido = obterId($queryObterId, $colunaId);
        }
    }
    return $idObtido;
}
function verificaDuplicados($verificaTabela, $verificaColuna, $VerificaDado, $colunaId)
{
    $con = $_SESSION["conexao"];
    $sql = "SELECT * FROM `{$verificaTabela}` WHERE {$verificaColuna} = '{$VerificaDado}'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        while ($result = mysqli_fetch_assoc($query))
        {
            $idObtido = $result[$colunaId];
        }
        return $idObtido;
    }
    else
    {
        return false;
    }
}
function atualizar($updateQuery)
{
    $con = $_SESSION["conexao"];
    $update = mysqli_query($con, $updateQuery);

    if (!mysqli_affected_rows($con) == 1)
    {
        mensagem("Erro ao atualizar cadastro!");
    }
}
function obterId($query, $id)
{
    $con = $_SESSION["conexao"];
    
    $select = mysqli_query($con, $query);

    if (mysqli_num_rows($select) > 0 )
    {
        while ($result  = mysqli_fetch_assoc($select))
        {
            $idObtido = $result[$id];
        } 
    }
    return $idObtido;
}

function insertEmprestimo($exemplarLivro, $nomeAluno, $dataEntrega)
{
    if(emprestimoDuplicado($nomeAluno ,$exemplarLivro))
    {
        $insertQuery = "INSERT INTO `emprestimolivro`(exemplarLivroId, alunoId, dataEmprestimo, dataRetorno) VALUES ({$exemplarLivro},{$nomeAluno},NOW(), '{$dataEntrega}' )";
        $con = $_SESSION["conexao"];
        $insert = mysqli_query($con, $insertQuery);

        if (!mysqli_affected_rows($con) == 1)
        {
            mensagem("Erro ao realizar emprestimo!");
        }
    }
    else
    {
        mensagem("Emprestimo já realizado!");
    }
}

function emprestimoDuplicado($nomeAluno, $exemplarLivro)
{
    $con = $_SESSION["conexao"];
    $sql = "SELECT * FROM emprestimolivro WHERE alunoId='{$nomeAluno}' AND exemplarLivroId='{$exemplarLivro}'";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0)
    {
        return false;
    }
    return true;
}

function mensagem($mensagem)
{
    ?>
    <script>
        window.location.href = "../index.html";
        var msg = <?php echo json_encode($mensagem) ?>;
        alert(msg);
    </script>
    <?php
}

?>

