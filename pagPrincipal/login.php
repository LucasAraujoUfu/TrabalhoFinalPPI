<?php

function checkLogin($pdo,$email,$senha){

    $sql = <<<SQL
        SELECT hash_senha
        FROM cliente
        WHERE email = ?
        SQL;
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if(!$row)return false;

        return password_verify($senha,$row['hash_senha']);
    }
    catch(Exception $e){
        exit('Falha inesperada: ' . $e->getMessage());
    }
}



require "../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"]??"";
$senha = $_POST["senha"]??"";

if(checkLogin($pdo,$email,$senha))
    header("location: home.html");
else
    header("location: index.html");


?>