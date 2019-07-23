<?php
    require_once 'disciplinaconec.php';
    $d = new Disciplina("projeto_login","localhost","root","");
?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Cadastrar Disciplinas</title>
	<link rel="stylesheet"href="newstyle.css">	
	</head>
	<div class="menutadm">
				<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="cadastrardi.php">Disciplinas</a></li>
				<li><a href="materiais.php">View</a></li>
				<li><a href="pagaluno.php">Sair</a></li>
			</ul>
		</div>
<body>
	<?php
	if (isset($_POST['nomedisci'])) //clicou no botão cadastrar ou editar
	{
          //------------EDITAR------------\\
          if(isset($_GET['id_up']) && !empty($_GET['id_up']))
          {
            $id_upd = addslashes($_GET['id_up']);
            $nomedisci = addslashes($_POST['nomedisci']);
        $nivel = addslashes($_POST['nivel']);
        $professor = addslashes($_POST['professor']);
        if (!empty($nomedisci) && !empty($nivel) && !empty($professor)) {
           //EDITAR OU ATUALIZAR
        
        !$d->atualizarDados($id_upd,$nomedisci, $nivel, $professor);
        header("location: cadastrardi.php");

    }  
    else
    {
        echo "Preencha todos os campos";
    }

          }
      

        //---------------CADASTRAR-----------

        else{
		$nomedisci = addslashes($_POST['nomedisci']);
		$nivel = addslashes($_POST['nivel']);
		$professor = addslashes($_POST['professor']);
		if (!empty($nomedisci) && !empty($nivel) && !empty($professor)){
           //cadastrar
		if (!$d->cadastrar($nomedisci, $nivel, $professor)) 
	  {
    	echo "Professor já cadastrado!";
	  }

    }  
    else
    {
    	echo "Preencha todos os campos";
    }	
}
}
	?>
    <?php
    if (isset($_GET['id_up'])) //essa função muda o nome do botão para atualizar quando for alterar o user. Vai ser acionada quando o user clicar no botão editar
    {
       $id_update = addslashes($_GET['id_up']);
       $res = $d->buscarDadosPessoa($id_update);
    }
        

    ?>
     <section id="direita">
     	<form method="POST">
     		<h2>Cadastrar Disciplinas</h2>
     		<hr><br><br>

     		<label for="nomedisci">Disciplina</label>
     		<input type="text" placeholder="NOME DA DISCIPLINA" name="nomedisci" id="nomedisci" value="<?php if(isset($res)){echo $res['nomedisci'];}?>">


     		<label for="professor">Nível</label>
     		<input type="text" placeholder="FUNDAMENTAL,MÉDIO OU SUPERIOR" name="nivel" id="nivel" value="<?php if(isset($res)){echo $res['nivel'];}?>">


     		<label for="nivel">Professor</label>
     		<input type="text" placeholder="NOME COMPLETO" name="professor" id="professor" value="<?php if(isset($res)){echo $res['professor'];}?>">


     		<br>

     		<input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">


     	</form>
     	
     </section>
     <section id="esquerda">
     	<table>
     		<tr id="titulo">
     	<td>DISCIPLINA</td>
     	<td>NÍVEL</td>
     	<td colspan="2">PROFESSOR</td>
     	</tr>
     	<?php
     	    $dados = $d->listar(); //INDFORMAÇÃO DE TODAS AS PESSOAS
     	    if(count($dados) > 0)//SE TEM PESSOAS CADASTRADAS NO BANCO
     	    {
     	    	for ($i=0; $i < count($dados); $i++) 
     	    	//FOR QUE VAI DA PRIMEIRA PESSOA À ULTIMA, ATINGIR O TAMANHO TOTAL DO ARRAY COUNT E REPETE I++;

     	    	{ 
     	    		echo "<tr>";
     	    		foreach ($dados[$i] as $k => $v) 
     	    		{
     	    			if($k != "id_usuario") //OS DADOS APRESENTADOS NA TABELA NÃO PODEM CONTER O ID;
     	    			{
                           echo"<td>".$v."</td>";
     	    			}
     	    			
     	    		}
                   ?>

                    <td>

                    	<a href="cadastrardi.php?id_up=<?php echo $dados[$i]['id_usuario'];?>"class="botaodoodio">Editar</a>
                    	<a href="cadastrardi.php?id_usuario=<?php echo $dados[$i]['id_usuario'];?>" class="botaodoodio2">Excluir</a>
                    </td>

                    <?php	

     	    		echo "</tr>";
     	    		
     	    	}
     	    }
     	    else//O BANCO ESTÁ VAZIO
     	    {
                    echo "Ainda não há disciplinas cadastradas!";
     	    }
     	    		?>

     	  
            
     	    		<?php
     	    
             
     	?>
     	
   
     		
     	
     	</table>
     </section>

    </body>
    </html> 


<?php

   if(isset($_GET['id_usuario']))
   {
    $id = addslashes($_GET['id_usuario']);
    $d->excluir($id);
    header("location: cadastrardi.php");
   }

?>