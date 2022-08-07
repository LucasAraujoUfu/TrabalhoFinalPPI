<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

class Anuncio{
	public $titulo;
	public $descricao;
	public $preco;
	public $data;
	public $cep;
	public $bairro;
	public $cidade;
   	public $estado;
}


section_start();

$q = <<<SQL
	SELECT * FROM anuncio INNER JOIN anunciante ON anuncio.codigo_anunciante=anunciante.codigo WHERE anunciante.email = ?;
	SQL;
	
	$mail = $_SECTION["email"]??""; 
	
	if($mail==""){
		header("Location: index.html");
		exit();
	}
	
	try{
		$stmt = $pdo->prepare(q);
		$stmt->execute([$mail]);
		
		$v = []
		
		while($row = $stmt->fetch()){
			v[] = new Anuncio($row['titulo'],$row['descricao'],$row['preco']
								,$row['data_hora'],$row['cep'],$row['bairro']
								,$row['cidade'],$row['estado']);
		}
		
		echo json_encode($v);
		
	}
	catch(Exception $e){
		exit("Falha inesperada");
	}

?>
