<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Connecter</title>
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/pied.css">

		<link rel="icon" href="img/Parole.ico" type="image/x-icon" />
	</head>
	<body class="loggedin" >

		<nav class="navtop header_index">
			
			<p class="logo" ></p>

			<span class="login100-form-title-1" >
				<!-- <h1>Gestion des demanades "Parole &nbsp;<i class="fa fa-microphone fa-1x" ></i>" </h1> -->
				<h1>Parole</h1>
			</span>
			
		</nav>	
		<hr>


		<div class="content" style="width: 100%;" >

		<div class="pp" > 

		<div class="login">
			<h1> 
				<!-- <img src="img/download.png" width="100" height="65" style="margin-top: -5px; border: 1px solid #fff; " > -->
				Connecter
			</h1>
			<form action="login.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Nom d'utilisateur" id="username" required>
				<br>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Mot de passe" id="password" required>
				<input type="submit" value="Connecter">
			</form>
		</div>
	</div>
	</div>

<?php
			require 'pied.php';
?>
	</body>
</html>