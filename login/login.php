<?php

require_once "../conexaoMysql.php";
require_once "autenticacao.php";
session_start();

class RequestResponse{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}


$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();
if($hash_senha = confereSenha($pdo, $email, $senha)){
    $_SESSION['emailLogin'] = $email;
    $_SESSION['loginString'] = hash('sha512', $hash_senha . $_SERVER['HTTP_USER_AGENT']);  
    $response = new RequestResponse(true, '../restrita/index.php');
}else
$response = new RequestResponse(false, ''); 

echo json_encode($response);