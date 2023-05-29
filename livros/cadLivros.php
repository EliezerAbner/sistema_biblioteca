<?php 
    require_once '../conexao.php';

    if(isset($_POST["btnCadastrar"]))
    {
        if(verificaVazios())
        {
            $titulo = $_POST["txtTitulo"];
            $nomeAutor = $_POST["txtAutor"];
            $nomeEditora = $_POST["txtEditora"]; 
            $anoPublicacao = $_POST["txtAno"];
            
            insert("INSERT INTO editora (nomeEditora) VALUES ('{$nomeEditora}')");
            $editoraId = obterId("SELECT max(editoraId) AS editoraId FROM editora", "editoraId");

            insert("INSERT INTO livro (editoraId, nomeLivro, anoPublicacao) VALUES ('{$editoraId}','{$titulo}', '{$anoPublicacao}')");
            $livroId = obterId("SELECT max(livroId) AS livroId FROM livro ", "livroId");

            insert("INSERT INTO autor (nomeAutor) VALUES ('{$nomeAutor}')");
            $autorId = obterId("SELECT max(autorId) AS autorId FROM autor", "autorId");

            insert("INSERT INTO autorLivro (autorId, livroId) VALUES ('{$autorId}', '{$livroId}')");
            
            ?>
            <script>
                window.location.href = "../index.html";
                var msg = <?php echo json_encode("Livro cadastrado com sucesso!") ?>;
                alert(msg);
            </script>
            <?php
        }
    }

    function insert($sql)
    {  
        $con = $_SESSION["conexao"];

        $insert = mysqli_query($con, $sql);

        if (!mysqli_affected_rows($con) == 1)
        {
            mensagem("Erro ao cadastrar o livro");
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


