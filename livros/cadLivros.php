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
            $qtde = $_POST["txtQtde"];
            
            $editoraId = insert("INSERT INTO editora (nomeEditora) VALUES ('{$nomeEditora}')", "editora", "nomeEditora", "$nomeEditora", "SELECT max(editoraId) AS editoraId FROM editora", "editoraId");
            $livroId = insert("INSERT INTO livro (editoraId, nomeLivro, anoPublicacao) VALUES ('{$editoraId}','{$titulo}', '{$anoPublicacao}')", "livro", "nomeLivro", $titulo, "SELECT max(livroId) AS livroId FROM livro ", "livroId");
            $autorId = insert("INSERT INTO autor (nomeAutor) VALUES ('{$nomeAutor}')", "autor", "nomeAutor", $nomeAutor, "SELECT max(autorId) AS autorId FROM autor", "autorId");
            $insert = insert("INSERT INTO autorLivro (autorId, livroId) VALUES ('{$autorId}', '{$livroId}')", "autorLivro", "livroId", $livroId, "", "");
            
            $insertExemplarLivro = insert("INSERT INTO exemplarLivro (livroId, numeroExemplar) VALUES ({'$livroId'}, {'$qtde'})", "exemplarLivro", "livroId", "$livroId", "","" );
            
            mensagem("Livro cadastrado com sucesso!");
        }
    }
    else if (isset($_POST["btnAtualizar"]))
    {
        if (verificaVazios())
        {
            $titulo = $_POST["txtTitulo"];
            $nomeAutor = $_POST["txtAutor"];
            $nomeEditora = $_POST["txtEditora"]; 
            $anoPublicacao = $_POST["txtAno"];  
            
            $editoraId = obterId("SELECT * FROM `editora` WHERE nomeEditora = '{$nomeEditora}'","editoraId");
            atualizar("UPDATE `editora` SET nomeEditora='{$nomeEditora}' WHERE editoraId='{$editoraId}'");

            $livroId = obterId("SELECT * FROM `livro` WHERE nomeLivro = '{$titulo}'","livroId");
            atualizar("UPDATE `livro` SET editoraId='{$editoraId}', nomeLivro='{$titulo}', anoPublicacao='{$anoPublicacao}' WHERE livroId='{$livroId}'");

            $autorId = obterId("SELECT * FROM `autor` WHERE nomeAutor = '{$nomeAutor}'","autorId");
            atualizar("UPDATE `autor` SET nomeAutor='{$nomeAutor}' WHERE autorId='{$autorId}'");

            $autorLivroId = obterId("SELECT * FROM `autorLivro` WHERE livroId = '{$livroId}'","autorLivroId");
            atualizar("UPDATE `autorLivro` SET autorId='{$autorId}', livroId='{$livroId}' WHERE autorLivroId='{$autorLivroId}'");

            mensagem("Livro atualizado com sucesso!");
        }
    }

    function verificaVazios()
    {
        if($_POST["txtTitulo"] == "" || $_POST["txtAutor"] == "" || $_POST["txtEditora"] == "" || $_POST["txtAno"] == "" || $_POST["txtQtde"] || "")
        {
            ?>
            <script>
                window.location.href = "cadLivros.html";
                var msg = <?php echo json_encode("Preencha os campos!") ?>;
                alert(msg);
            </script>
            <?php
        }
        else
        {
            return true;
        }
    }


