<?php
    require_once '../conexao.php';

    $query = "SELECT * FROM aluno";
    $con = $_SESSION["conexao"];
    
    $select = mysqli_query($con, $query);

    if (mysqli_num_rows($select) > 0 )
    {
        while ($result  = mysqli_fetch_assoc($select))
        {
            ?>
            <tr>
                <td><?php $nomeAluno = $result["nomeAluno"] ?></td>
                <td><?php $dataNascimento = $result["nomeAluno"] ?></td>
            </tr>
            <?php
        } 
    }
    return $idObtido; 
?>