<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    session_start();
    $email = $_SESSION["email"];

    if($email === ""){
        header("Location: ../index.html");
        exit();
    }else{
        $title = $_POST["title"];
        $descricao = $_POST["descricao"];
        $categoria = $_POST["categoria"];
        $preco = $_POST["preco"];
        $cep = $_POST["cep"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $img = $_FILES['tmp_name'];
        $srcImg = "./img/imgAnuns/" + $img;

        $sql = <<<sql
            SELECT codigo_anunciante FROM anunciante
                WHERE anunciante.email = ?
        sql;
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            $id = $row["codigo_anunciante"];
        }catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
        try{
            $sql = <<<sql
                INSERT INTO anuncio (titulo, descricao, preco, data_hora, cep, bairro, cidade, estado, codigo_anunciante, codigo_categoria)
                VALUES (?,?,?,now(),?,?,?,?,?,?)
            sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $descricao, $preco, $cep, $bairro, $cidade, $estado, $id, $categoria]);
        }catch (Exception $e) {
            exit('Ocorreu uma falha: ' . $e->getMessage());
        }
        $sql = <<<sql
            SELECT codigo_anuncio FROM anuncio
                WHERE anuncio.titulo = ?
                    AND anuncio.codigo_anunciante = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $id]);
        $row = $stmt->fetch();
        $codigo_anuncio = $row["codigo_anuncio"];
        $sql = <<<sql
            INSERT INTO foto VALUES
                (?,?)
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$srcImg, $codigo_anuncio]);
        // movendo a foto para o diretorio;
        move_uploaded_file($_FILES['tmp_name'], $img);

        //depois de realizar o INSERT, o php fará uma verificação se o endereço existe na baseEndAJAX
        $sql = <<<sql
            SELECT * FROM baseEndAjax
                WHERE baseEndAjax.cep = ?
        sql;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep]);
        $bool = $stmt->fetch();
        if(!$bool){
            $sql = <<<sql
                INSERT INTO baseEndAjax VALUES
                    (?,?,?)
            sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cep, $cidade, $estado]);
        }
    }
?>