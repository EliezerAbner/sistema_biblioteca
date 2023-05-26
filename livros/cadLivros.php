<?php 
    if(isset($_POST["btnCadastrar"]))
    {
        if(verificaVazios())
        {
            $titulo = $_POST["txtTitulo"];
            $nomeAutor = $_POST["txtAutor"];
            $nomeEditora = $_POST["txtEditora"]; 
            $anoPublicacao = $_POST["txtAno"];

            $sqlLivro = "INSERT INTO livro(nomeLivro, anoPublicacao) VALUES ('{$titulo}', '{$anoPublicacao}')";

            $insertTblLivro = mysqli_query($conn, $sql);

            if (!mysqli_affected_rows($conn) == 1)
            {
                mensagem("Erro ao cadastrar o livro");
            }
            else
            {
                ?>
                <script>
                    window.location.href = "../index.html";
                    var msg = <?php echo json_encode("Livro cadastrado com sucesso!") ?>;
                    alert(msg);
                </script>
                <?php
            }
        }
    }

    function verificaVazios()
    {
        if($_POST["txtTitulo"] == "" || $_POST["txtAutor"] == "" || $_POST["txtEditora"] == "" || $_POST["txtAno"] == "")
        {
            mensagem("Preencha os campos");
        }
        else
        {
            return true;
        }
    }

    function mensagem($msg)
    {
        ?>
        <script>
            window.location.href = "cadLivros.html";
            var msg = <?php echo json_encode($msg) ?>;
            alert(msg);
        </script>
        <?php
    }
?>