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
		<title>Création d'un compte</title>

		
		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>		

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/ajouteruser.css">


<script type="text/javascript">
	$(function(){

		$(".toggle-password").click(function() {
			  $(this).toggleClass("fa-eye fa-eye-slash");
			  var input = $($(this).prev());
			  if (input.attr("type") == "password") {
			    input.attr("type", "text");
			  } else {
			    input.attr("type", "password");
			  }
		});	
});

</script>

	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content" style="width:95%" >
			<h2>Création d'un compte</h2>
			<div class="pp" > 



<?php



		include 'user.php';

	//print_r($_POST);
	
	if(isset($_POST['service']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_type']) ){

			
		$exist = ajouterUser($_POST['service'], $_POST['username'], $_POST['password'], $_POST['user_type']);

		if ($exist==0) {

			echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong><i class="fas fa-exclamation-circle" ></i></strong> Compte "'.$_POST['service'].'" est crée avec Succès. 
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

		} else {

			echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Ce compte est exist déjà. 
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>');

		}
						
	}else{
		//echo " not isset !!!!!";
	}					
		


?>

		<center><div class="signin" >
			<h1><i class="fas fa-user-plus" ></i> Ajouter Nouveau Compte</h1>
			<p>
				<form action="Ajouter_user.php" method="post">

					<label for="service"></label>
					<input type="text" name="service" placeholder="Service" id="service" required>
					

					<label for="username"></label>
					<input type="text" name="username" placeholder="Nom d'utilisateur" id="username" required>
					

					<label for="password"></label>
					<input type="password" name="password" placeholder="Mot de passe" id="password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
  					<!-- radio -->
					  <div class="custom-control custom-radio">
					    <input type="radio" class="custom-control-input " id="au" name="user_type" value="1"  >
					    <label class="custom-control-label" for="au"> Administrateur </label>
					  </div>
					  &nbsp;&nbsp;
					  <div class="custom-control custom-radio"  >
					    <input type="radio" class="custom-control-input" id="su" name="user_type" value="0"  checked >
					    <label class="custom-control-label" for="su">Utilisateur standard </label>
					  </div>

					
					<table border="0" style="width:90%; margin-top: 20px;" cellpadding="5" >
						<tbody>
							<tr>
								<td>
									<button type="submit" class="btn btn-success  btn-block submit"><i class="far fa-check-circle" ></i> Enregistrer</button>
								</td>
								<td>
									<a href="javascript:history.back()" class="btn btn-secondary btn-block" role="button"><i class="fas fa-ban" ></i>  Annuler</a>
								</td>
							</tr>
						</tbody>
					</table>
					
				</form>
			</p>
			</div></center>
			</div>
		
		</div>

	</body>
</html>
