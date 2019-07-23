<?php

Class Usuario
{
	private $pdo;
	public $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha)
	{
             global $pdo;
             try
	{
              $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

	} catch (PDOException $e) {
          $msgErro = $e->getMessage();
	}
}

	public function cadastrar($nome, $email, $idade, $senha)
	{
              global $pdo;
              //verificar se já existe o email cadastrado
              $sql = $pdo->prepare("SELECT id_usuario FROM cadastrouser WHERE email = :e");
              $sql->bindValue(":e",$email);
              $sql->execute();
              if($sql->rowCount() > 0)
              {
              	return false; //ja esta cadastrada
              }
              else
              {
              	//caso não, cadastrar
              	$sql = $pdo->prepare("INSERT INTO cadastrouser (nome, email, idade, senha) VALUES (:n, :e, :i, :s)");
              	$sql->bindValue(":n", $nome);
              	$sql->bindValue(":e", $email);
              	$sql->bindValue(":i", $idade);
              	$sql->bindValue(":s",$senha);
              	$sql->execute();
              	return true; //tudo ok
              }

             
              
}
	public function logar($email, $senha)
    {
             global $pdo;

             $sql = $pdo->prepare("SELECT id_usuario FROM cadastrouser WHERE email = :e AND senha = :s");
             $sql->bindValue(":e", $email);
              $sql->bindValue(":s",$senha);
              $sql->execute();
              if($sql->rowCount() > 0)
              {
              	//entrar no sistema
              	$dado = $sql->fetch();
              	session_start();
              	$_SESSION['id_usuario'] = $dado['id_usuario'];
              	return true; //cadastrado com sucesso
              }
              else
              {
               return false; //não conseguiu logar
              }

    }

}