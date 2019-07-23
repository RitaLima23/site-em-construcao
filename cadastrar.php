<?php
    require_once 'usuarios.php';
    $u = new Usuario;
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
	<link rel="stylesheet"href="style.css">	
</head>
<body>
	  <div id="corpo-form-cad"> 
	  	<h1>Tela de Cadastro</h1>
	  	<form method="POST">
	  		<input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
	  		<input type="text" name="email" placeholder="Email" maxlength="50">
	  		<input type="int" name="idade" placeholder="Idade" maxlength="2">
	  	    <input type="password" name="senha" placeholder="Senha" maxlength="8">
	  	    <input type="submit" value="Cadastrar">
	  	</form>
	  </div>
 <?php
 
 if(isset($_POST['nome']))
 {
         $nome = addslashes($_POST['nome']);
         $email = addslashes($_POST['email']);
         $idade = addslashes($_POST['idade']);
         $senha = addslashes($_POST['senha']);
         

         if(!empty($nome) && !empty($email) && !empty($idade) &&    !empty($senha))
 {

      $u->conectar("projeto_login","localhost","root","");
      if($u->msgErro == "")//esta tudo certo
      {

          if($u->cadastrar($nome,$email,$idade,$senha))
          {
             ?>
             <div id="msg-sucesso">
               Cadastrado com sucesso! Acesse para entrar!
             </div>
             <?php           
          }
          else
          {

          	?>
             <div class="msg-erro">
               Email já cadastrado!
             </div>
             <?php
          }
      }
     } 
      else
      {

        ?>
             <div class="msg-erro">
               <?php echo "Erro: ".$u->msgErro;?>
             </div>
             <?php    	
      }	

  }else
  {
  	
      ?>
             <div class="msg-erro">
               Preencha todos os campos!
             </div>
             <?php   
  }
?>
</body>
</html>