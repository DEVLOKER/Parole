<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supprimer un compte</title>

		
		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>		

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">


	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content" style="width:95%" >
			<h2>Supprission d'un compte</h2>
			<div class="pp" > 


<?php 
		
	include 'user.php';
				
	if(isset($_GET['id'])) {

				$readUser_  = readUser($_GET['id']); $compte_ = $readUser_['service'];

				$more_than_one_admin = supprimerUser($_GET['id']);

				if(!$more_than_one_admin){

					  echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Impossible de supprimer le dernier compte Administrateur  <b>"'.$compte_.'"</b>!
							  <br> (La base de donnée il faut contient au moins un compte Administrateur).
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>');
						echo ('
						<script type="text/javascript">
								setTimeout(function(){ 
									window.location.href = "Gestion_Comptes.php";
								}, 5000);
						</script>');


				}else{

						echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation-circle" ></i></strong> Compte "'.$compte_.'" est supprimer avec succès. 
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>');
						echo ('
						<script type="text/javascript">
								setTimeout(function(){ 
									window.location.href = "Gestion_Comptes.php";
								}, 3000);
						</script>');


				}



				//header('Location: Gestion_Comptes.php');
	}

?>


</div>
		
		</div>

	</body>
</html>