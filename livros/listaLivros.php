<?php
require_once '../conexao.php';

$query = "SELECT * FROM lista_livros";
$con = $_SESSION["conexao"];

$select = mysqli_query($con, $query);

if (mysqli_num_rows($select) > 0 )
{
    while ($result  = mysqli_fetch_assoc($select))
    {
        $nomeLivro = $result["nomeLivro"];
        $anoPublicacao = $result["anoPublicacao"];
        $nomeAutor = $result["nomeAutor"];
        $nomeEditora = $result["nomeEditora"];

        ?>
        <html>
            <head>
                <link rel="stylesheet" href="listaLivros.css">
            </head>
            <body>
                <table>
                    <tr>
                        <th>Livro</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Ano de Publicação</th>
                    </tr>
                    <tr>
                        <td><?php echo $nomeLivro ?></td>
                        <td><?php echo $nomeAutor ?></td>
                        <td><?php echo $nomeEditora ?></td>
                        <td><?php echo $anoPublicacao ?></td>
                    </tr>
                </table>
            </body>
        </html>
        <?php
    }
}