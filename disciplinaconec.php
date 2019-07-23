<?php

Class Disciplina{

         
         private $pdo;
         public function __construct($nome, $host, $usuario, $senha)
         {
         try{
         
         	$this->pdo=new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
         
             }

              catch (PDOException $e) {
               echo "Erro com Banco de Dados:" .$e->getMessage();
               exit();
	}
	catch (PDOException $e) {
              echo "Erro generico:" .$e->getMessage();
              exit();
		}

	}



	//Função para buscar os dados e exibir na coluna esquerda da tela
	public function listar()
	{
		$res = array();
		$cmd = $this->pdo->query("SELECT * FROM cadastrodisciplinas ORDER BY professor");
		$res = $cmd->fetchAll(PDO::FETCH_ASSOC); //transforma os dados em uma matriz, pois vem mais de uma informação;
		return $res;
	}

   public function cadastrar($nomedisci, $nivel, $professor)
   {

    //ANTES DE CADASTRAR VERIFICAR SE JÁ TEM O PROFESSOR CADASTRADO 
   	$cmd = $this->pdo->prepare("SELECT id_usuario FROM cadastrodisciplinas WHERE professor = :p" );
   	$cmd->bindValue(":p",$professor);
   	$cmd->execute();
   	if($cmd->rowCount() > 0)
   	{
   		return false;
   	}else
   	{
   		$cmd = $this->pdo->prepare("INSERT INTO cadastrodisciplinas (nomedisci, nivel, professor) VALUES (:d, :n, :p)");
   			$cmd->bindValue(":d", $nomedisci);
   			$cmd->bindValue(":n", $nivel);
   			$cmd->bindValue(":p", $professor);
   			$cmd->execute();
   			return true;
   	}

   }

   public function excluir($id_usuario)
   {
   	$cmd = $this->pdo->prepare("DELETE FROM cadastrodisciplinas WHERE id_usuario = :id");

   $cmd->bindValue(":id",$id_usuario);
   $cmd->execute();
   
   }

   //BUSCAR DADOS DE DETERMINADA PESSOA

   public function buscarDadosPessoa($id_usuario){

   	$res = array();
   	$cmd = $this->pdo->prepare("SELECT * FROM cadastrodisciplinas WHERE id_usuario = :id");
   
   	$cmd->bindValue(":id",$id_usuario);
   	$cmd->execute();
   	$res = $cmd->fetch(PDO::FETCH_ASSOC);//Transforma em array
   	return $res;

   }

   //ATUALIZA OS DADOS NO BD

   public function atualizarDados($id_usuario,$nomedisci, $nivel, $professor){


   	     $cmd = $this->pdo->prepare("UPDATE cadastrodisciplinas SET nomedisci = :d, nivel=:n, professor=:p WHERE id_usuario = :id");
   	        
   	        $cmd->bindValue(":d",$nomedisci);
   	        $cmd->bindValue(":n",$nivel);
   	        $cmd->bindValue(":p",$professor);
   	        $cmd->bindValue(":id",$id_usuario);
            $cmd->execute();
            return true;

   }

}

?>
