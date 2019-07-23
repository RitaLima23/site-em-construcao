<!DOCTYPE html>
<html>
<head>
	<title>Minhas Disciplinas</title>
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

		<div class="corpito">
			
		<nav>
		<ul class="menuli">
			<a href="index.php"><li>Cadatrar Disciplinas</li>
			<a href="aluno.php"><li>View</li></a>
			<a href="professor.php"><li>Cadastrar Professor</li></a>

		</ul>	
	</nav>
		<section>
			<h1>Cadastro de Usuários</h1>
			<hr><br><br>

			<form method="post" action="processa.php">
			<input type="submit" value="Salvar" class="btn">
			<input type="reset" value="Limpar" class="btn">
			<br><br>

			Nome<br>
			<input type="text" name="nome" class="campo" maxlength="40" required autofocus><br>
			Email<br>
			<input type="email" name="email" class="campo" maxlength="50" required><br>
			Profissão<br>
			<input type="text" name="profissao" class="campo" maxlength="40" required ><br>

        </form>
		</section>
		</div>
	</body>
</html>
