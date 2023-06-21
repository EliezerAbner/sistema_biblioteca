<?php
    require_once '../conexao.php';

    $query = "SELECT * FROM aluno";
    $con = $_SESSION["conexao"];
    
    $select = mysqli_query($con, $query);

    if (mysqli_num_rows($select) > 0 )
    {
        while ($result  = mysqli_fetch_assoc($select))
        {

            $nomeAluno = $result["nomeAluno"];
            $dataNascimento = $result["dataNascimento"];
            $cpfAluno = $result["cpf"];

            ?>
            <tr>
                <td><?php echo $nomeAluno ?></td>
                <td><?php echo $dataNascimento ?></td>
                <td><?php echo $cpfAluno ?></td>
            </tr><br>
            <?php
        } 
    } 
?>