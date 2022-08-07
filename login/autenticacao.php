<?php 

function confereSenha($pdo,$email,$senha){

    $sql = <<<SQL
        SELECT hash_senha
        FROM anunciante
        WHERE email = ?
        SQL;
    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $hash_senha = $stmt->fetchColumn();

        if (!$hash_senha) 
            return false; 
        if(!password_verify($senha, $hash_senha))
            return false;

        return $hash_senha;
    }catch(Exception $e){
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

function confereLogin($pdo){
    if(!isset($_SESSION['emailLogin'], $_SESSION['loginString']))
        return false;

    $email = $_SESSION['emailLogin'];

    $sql = <<<SQL
        SELECT hash_senha
        FROM anunciante
        WHERE email = ?
        SQL;

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $hash_senha = $stmt->fetchColumn();
        if(!$hash_senha)
            return false;

        $loginStringCheck = hash('sha512', $hash_senha . $_SERVER['HTTP_USER_AGENT']);
        if(!hash_equals($loginStringCheck, $_SESSION['loginString']))
            return false;
        return true;
    }catch(Exception $e){
        exit('Falha inesperada: ' . $e->getMessage());
    }
}

function naoLogado($pdo){
    if(!confereLogin($pdo)){
        header("Location: ../negado.html");
        exit();
    }
}

?>