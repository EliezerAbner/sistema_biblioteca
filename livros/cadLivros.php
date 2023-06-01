<?php 
    require_once '../conexao.php';
    require '../crud.php';

    if(isset($_POST["btnCadastrar"]))
    {
        if(verificaVazios())
        {
            $titulo = $_POST["txtTitulo"];
            $nomeAutor = $_POST["txtAutor"];
            $nomeEditora = $_POST["txtEditora"]; 
            $anoPublicacao = $_POST["txtAno"];
            
            $editoraId = insert("INSERT INTO editora (nomeEditora) VALUES ('{$nomeEditora}')", "editora", "nomeEditora", "$nomeEditora", "SELECT max(editoraId) AS editoraId FROM editora", "editoraId");

            $livroId = insert("INSERT INTO livro (editoraId, nomeLivro, anoPublicacao) VALUES ('{$editoraId}','{$titulo}', '{$anoPublicacao}')", "livro", "nomeLivro", $titulo, "SELECT max(livroId) AS livroId FROM livro ", "livroId");

            $autorId = insert("INSERT INTO autor (nomeAutor) VALUES ('{$nomeAutor}')", "autor", "nomeAutor", $nomeAutor, "SELECT max(autorId) AS autorId FROM autor", "autorId");

            $insert = insert("INSERT INTO autorLivro (autorId, livroId) VALUES ('{$autorId}', '{$livroId}')", "autorLivro", "livroId", $livroId, "", "");
            
            ?>
            <script>
                window.location.href = "../index.html";
                var msg = <?php echo json_encode("Livro cadastrado com sucesso!") ?>;
                alert(msg);
            </script>
            <?php
        }
    }


