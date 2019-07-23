<?php
//-------------------CONEXAO--------------------
try{

$pdo = new PDO("mysql:dbname=projeto_login;host:localhost","root",""); 

} 

catch (PDOException $e) {
	echo "Erro com banco de dados:".$e->getMessage();

}
catch (Exception $e)     
{
    echo "Erro generico: ".$e->getMessage();;
}

//-------------------INSERT--------------------
$pdo->prepare("INSERT INTO cadastrodisciplinas(nomedisci,professor,idade,senha) VALUES (:n,:p,:i,:s)");

$pdo->query();


?>