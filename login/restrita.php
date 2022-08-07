<?php

require_once "../conexaoMysql.php";
require_once "autenticacao.php";

session_start();
$pdo = mysqlConnect();
naoLogado($pdo);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <title>Formulário de Login</title>
</head>
<body>
    <header>
        <div class="topo">
            <div class="logo"><img src="../images/logotipoCLL.png" alt="imagem contendo logo do site chamado CLL"></div>
            <div class="acesso">
                <p>MINHA CONTA</p>
                <a href="login.html">ENTRAR /</a><a href="../cadastro/cadastro.html">CADASTRAR</a> 
            </div>
        </div>
    </header>
    <nav>
        <button class="avancada" type="button">Busca avançada</button>
        <div class="busca">
            <input type="text" width="" placeholder="Digite o produto desejado...">
            <button type="submit"><a href=""><img src="../images/search-interface-symbol.png" alt="imagem do botão pesquisar"></a></button>
        </div>
    </nav>
    <main>
        <p>Bem vindo(a) à página restrita!</p>
    </main>
    <footer><p>©2022 PPI-UFU</p></footer>
</body>
</html>