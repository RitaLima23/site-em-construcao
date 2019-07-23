<?php
   session_start();
   if(!isset($_SESSION['id_usuario']))
   {
   	header("location:index.php");
   	exit;
   }

?>

<html>
<head>
	<title>Disciplinas favoritas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css" />	
</head>
<body>
		<div class="menut">
				<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="disciplinas.php">Disciplinas</a></li>
				<li><a href="reforço.php">Reforço</a></li>
				<li><a href="materiais.php">Materiais</a></li>
				<li><a href="pagaluno.php">Sair</a></li>
			</ul>
		</div>
	<div class="w3-contentw3-section" style="max-width:500px">
   <h1>---- Bem Vindo ! ----</h1>
  <img class="mySlides w3-animate-fading" src="gatinhofofo1.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="gatinhofofo2.jpg" style="width:100%">
  <img class="mySlides w3-animate-fading" src="gatinhofofo3.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000);    
}
</script>
      
      
	
	</body>
</html>