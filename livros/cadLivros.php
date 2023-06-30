<?php 
    require_once '../conexao.php';
    require '../crud.php';

    if(isset($_POST["btnCadastrar"]))
    {
        if(verificaVazios())
        {
            $autores[0] = $_POST["txtAutor"];
            $contadorAutores = 1;
            while(isset($_POST["txtAutor_$contadorAutores"]))
            {
                $autores[$contadorAutores] = $_POST["txtAutor_$contadorAutores"];
                $contadorAutores++;
            }

            $exemplares[0] = $_POST["txtCod"];
            $contadorExemplares = 1;
            while(isset($_POST["txtCod_$contadorExemplares"]))
            {
                $exemplares[$contadorExemplares] = $_POST["txtCod_$contadorExemplares"];
                $contadorExemplares++;
            }

            $titulo = $_POST["txtTitulo"];
            $nomeEditora = $_POST["txtEditora"]; 
            $anoPublicacao = $_POST["txtAno"];
            
            $editoraId = insert("INSERT INTO editora (nomeEditora) VALUES ('{$nomeEditora}')", "editora", "nomeEditora", "$nomeEditora", "SELECT max(editoraId) AS editoraId FROM editora", "editoraId");
            $livroId = insert("INSERT INTO livro (editoraId, nomeLivro, anoPublicacao) VALUES ('{$editoraId}','{$titulo}', '{$anoPublicacao}')", "livro", "nomeLivro", $titulo, "SELECT max(livroId) AS livroId FROM livro ", "livroId");

            $contador = 0;
            foreach ($autores as $autor)
            {
                $autorIds[$contador] = insert("INSERT INTO autor (nomeAutor) VALUES ('{$autor}')", "autor", "nomeAutor", $autor, "SELECT max(autorId) AS autorId FROM autor", "autorId");
                $contador++;
            }

            $contador = 0;
            foreach ($autorIds as $autorId)
            {
                insert("INSERT INTO autorLivro (autorId, livroId) VALUES ('{$autorId}', '{$livroId}')", "autorLivro", "livroId", $livroId, "", "");
                $contador++;
            }

            $contador = 0;
            foreach ($exemplares as $exemplar)
            {
                insert("INSERT INTO exemplarLivro (livroId, numeroExemplar) VALUES ({$livroId}, {$exemplar})", "exemplarLivro", "livroId", "$livroId", "","" );
                $contador++;
            }

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
        if($_POST["txtTitulo"] == "" || $_POST["txtAutor"] == "" || $_POST["txtEditora"] == "" || $_POST["txtAno"] == "" || $_POST["txtCod"] == "")
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


