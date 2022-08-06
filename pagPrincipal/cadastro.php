<?php
require "../conexaoMysql.php";

$pdo = mysqlConnect();

$nome =  $_POST["nome"]??"";
$cpf = $_POST["cpf"]??"";
$email = $_POST["mail"]??"";
$senha = $_POST["pass"]??"";
$tel = $_POST["tel"]??"";

$senha = password_hash($senha,PASSWORD_DEFAULT);

$sql = <<<SQL
        INSERT INTO (Nome, CPF, Email, SenhaHas, Telefone)
        VALUES (?,?,?,?,?); 
    SQL;

try{
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nome,$cpf,$email,$senha,$tel
    ]);

    header("location: index.html");
    exit();
}
catch (Exception $e){
    exit("Erro no cadastro");
}

?>