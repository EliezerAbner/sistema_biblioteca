<?php

require_once '../conexao.php';

function insert($insertQuery, $verificaTabela, $verificaColuna, $VerificaDado, $queryObterId, $colunaId)
{
    $idObtido = verificaDuplicados($verificaTabela, $verificaColuna, $VerificaDado, $colunaId);

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
    $sql = "SELECT * FROM '{$verificaTabela}' WHERE '{$verificaColuna}'='{'$VerificaDado'}'";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        while ($result = mysqli_fetch_assoc($query))
        {
            $idObtido = $result[$colunaId];
        }
        return $idObtido;
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

?>