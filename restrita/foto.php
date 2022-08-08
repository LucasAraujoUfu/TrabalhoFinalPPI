<?php
require "../conexaoMysql.php";

include 'functions.php';

$pdo = mysqlConnect();

if(!isset($_FOTO['nomeArqFoto'])){
    echo retorno('Selecione uma imagem');
    exit;
}

$foto = $_FOTO["foto"] ?? "";
$nome = $foto["nome"] ?? "";
$descricao = $foto["descricao"] ?? "";
$descricao = mysql_real_escape_string(strip_tags(stripslashes($foto['decricao']))); 

$conteudo = file_get_contents($foto['tmp_name']);

$sql = <<<SQL
    INSERT INTO categoria (nome, descricao, codigo_anunciante) 
    VALUES(?, ?, ?)
    SQL;

try {
    $pdo->beginTransaction();
  
    $idNovoAnunciante = $pdo->lastInsertId();
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([
    $nome, $descricao, $idNovoAnunciante
    ])) throw new Exception('Falha na segunda inserção');

    $pdo->commit();
    header("location: restrita.html"); 
    exit();
}catch{
    $pdo->rollBack();
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
?>