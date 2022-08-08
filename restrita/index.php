<?php

require_once "../conexaoMysql.php";
require_once "../login/autenticacao.php";

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
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleRestrita.css">
    <title>Formulário de Cadastro</title>
</head>
<body>
    <header>
        <div class="topo">
            <div class="logo"><img src="../images/logotipoCLL.png" alt="imagem contendo logo do site chamado CLL"></div>
            <div class="acesso">
                <p>MINHA CONTA</p>
                <a href="../login/logout.php">SAIR /</a><a href="../cadastro/cadastro.html">CADASTRAR</a> 
            </div>
        </div>
    </header>
    <nav>
        <button class="avancada" type="button">Busca avançada</button>
        <div class="busca"> <!--class="busca"-->
            <input type="text" placeholder="Digite o produto desejado...">
            <button type="submit"></button><a href="../busca/busca.html"><img src="../images/search-interface-symbol.png" alt="imagem do botão pesquisar"></a>
        </div>
    </nav>
    <main>
        <div class="container">
            <form style="margin: auto" class="row g-2" action="salvar.php" method="post">
                <div class="galeria">
                    <label class="imagens" tabindex="0">
                        <p class="insert">INSERIR IMAGEM</p>
                        <input class="imgInput" type="file" accept="image/*" name="nomeArqFoto">
                        <span class="imgImage" style="">
                            <img id="imgs" class="imgs" src="">
                        </span>
                    </label>
                </div>
                <div class="col-sm-7">
                    <label for="titulo" class="form-label">Título: </label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder=" ">
                </div>
                <div class="col-sm-4">
                    <label for="preco" class="form-label">Preço: </label>
                    <input type="preco" class="form-control" id="preco" name="preco" placeholder=" ">                 
                </div>
                <!--<div class="form-floating col-md-4">
                    <input type="datetime" class="form-control" id="data_hora" name="data_hora" placeholder=" ">
                    <label for="data_hora" class="form-label">Data e hora:</label>
                </div>-->
                <div class="col-sm-5">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="number" class="form-control" id="cep" name="cep" pattern="\d{2}\.\d{3}-\d{3}" placeholder="xx.xxx-xxx">
                </div>
                <div class="col-sm-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder=" ">
                </div>
                <div class="col-sm-4">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" placeholder=" ">
                </div>
                <div class="col-sm-4">                    
                    <label for="estado">Estado</label>
                    <select class="form-select" name="estado" id="estado">
                        <option selected>Sel.</option>
                        <option value="es">ES</option>
                        <option value="mg">MG</option>
                        <option value="RJ">RJ</option>
                        <option value="sp">SP</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <div class="form-group blue-border-focus">
                        <label for="exampleFormControlTextarea5">Descricao: </label>
                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"></textarea>
                    </div>
                </div>
                
                <div class="col-md-3 form-check">
                    <div class="nome">
                        <label for="nome">Categoria: </label>
                        <select id="categoria" name="categoria" class="form-select" required>
                            <option selected id="1">Veículo</option>
                            <option id="2">Eletroeletrônico</option>
                            <option id="3">Imóvel</option>
                            <option id="4">Móvel</option>
                            <option id="5">Vestuário</option>
                            <option id="6">Outro</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        </svg>
                        Cadastrar
                    </button>      
                </div>    
            </form>
        </div>
    </main>
    <footer><p>©2022 PPI-UFU</p></footer>

    <script>
        const inputFile =  document.querySelector('.imgInput');
        const spanImage = document.querySelector('.imgImage');

        inputFile.addEventListener('change', function(e){
            const inputTarget = e.target;
            const file = inputTarget.files[0];

            if (file){
                const reader = new FileReader();
                reader.addEventListener('load', function(e){
                    const readerTarget = e.target;
                    const img =  document.createElement('img');
                    img.src = readerTarget.result;
                    img.classList.add('imgs');

                    spanImage.appendChild(img);
                });
                reader.readAsDataURL(file);
            }else{
                spanImage.innerHTML = spanImageText;
            }
        })


    </script>
</body>
</html>