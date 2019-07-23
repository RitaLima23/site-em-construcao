<?php

Class Usuarioadm
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

	public function cadastrar($nome, $email, $funcao, $senha)
	{
              global $pdo;
              //verificar se já existe o email cadastrado
              $sql = $pdo->prepare("SELECT id_usuario FROM cadastroadm WHERE email = :e");
              $sql->bindValue(":e",$email);
              $sql->execute();
              if($sql->rowCount() > 0)
              {
              	return false; //ja esta cadastrada
              }
              else
              {
              	//caso não, cadastrar
              	$sql = $pdo->prepare("INSERT INTO cadastroadm (nome, email, funcao, senha) VALUES (:n, :e, :f, :s)");
              	$sql->bindValue(":n", $nome);
              	$sql->bindValue(":e", $email);
              	$sql->bindValue(":f", $funcao);
              	$sql->bindValue(":s",$senha);
              	$sql->execute();
              	return true; //tudo ok
              }

             
              
}
	public function logar($email, $senha)
    {
             global $pdo;

             $sql = $pdo->prepare("SELECT id_usuario FROM cadastroadm WHERE email = :e AND senha = :s");
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



public function incluir($nomedisci, $professor, $idade, $senha)
  {
              global $pdo;
              //verificar se já existe a disciplina cadastrado
              $sql = $pdo->prepare("SELECT id_usuario FROM cadastrodisciplinas WHERE nomedisci = :n");
              $sql->bindValue(":n",$nomedisci);
              $sql->execute();
              if($sql->rowCount() > 0)
              {
                return false; //ja esta cadastrada
              }
              else
              {
                //caso não, cadastrar
                $sql = $pdo->prepare("INSERT INTO cadastrodisciplinas (nomedisci, professor, idade, senha) VALUES (:n, :p, :i, :s)");
                $sql->bindValue(":n", $nomedisci);
                $sql->bindValue(":p", $professor);
                $sql->bindValue(":i", $idade);
                $sql->bindValue(":s",$senha);
                $sql->execute();
                return true; //tudo ok
              }
}
}
