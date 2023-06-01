<?php

require_once '../conexao.php';

function insert($insertQuery, $verificaTabela, $verificaColuna, $VerificaDado, $queryObterId, $colunaId)
{
    $idObtido = verificaDuplicados($verificaTabela, $verificaColuna, $VerificaDado, $colunaId);

    //var_dump($verificaColuna);
    //die();

    if($idObtido == false)
    {
        $con = $_SESSION["conexao"];
        $insert = mysqli_query($con, $insertQuery);

        if (!mysqli_affected_rows($con) == 1)
        {
            mensagem("Erro ao cadastrar o aluno");
        }
        if ($queryObterId != "") 
        {
            $idObtido = obterId($queryObterId, $colunaId);
        }
    }
    return $idObtido;
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
function verificaDuplicados($verificaTabela, $verificaColuna, $VerificaDado, $colunaId)
{
    $con = $_SESSION["conexao"];
    $sql = "SELECT * FROM `{$verificaTabela}` WHERE {$verificaColuna} = '{$VerificaDado}'";
    //var_dump($sql);
    //die();
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        while ($result = mysqli_fetch_assoc($query))
        {
            $idObtido = $result[$colunaId];
        }
        //var_dump($idObtido);
        //die();
        return $idObtido;
    }
    else
    {
        //var_dump("Deu negativo :(");
        //die();
        return false;
    }
}

?>

