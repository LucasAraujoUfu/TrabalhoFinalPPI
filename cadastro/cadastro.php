<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$telefone = $_POST["telefone"] ?? "";

$hash_senha = password_hash($senha, PASSWORD_DEFAULT);

    if(trim($nome) == "")
        $errorMsg = "O nome é obrigatório!";
    if(trim($cpf) == "")
        $errorMsg = "O cpf é obrigatório!";
    if(trim($email) == "")
        $errorMsg = "O email é obrigatório!";
    if(trim($senha) == "")
        $errorMsg = "A senha é obrigatória!";
    if(trim($telefone) == "")
        $errorMsg = "O telefone é obrigatório!";


try{
    $sql = <<<SQL
    INSERT INTO anunciante (nome, cpf, email, hash_senha, telefone)
    VALUES (?, ?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $email, $hash_senha, $telefone]);

    header("location: ../login/login.html");
    exit();
}catch (Exception $e){
    if ($e->errorInfo[1] === 1062)
        exit('Dados duplicados: ' . $e->getMessage());
    else
        exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

?>
