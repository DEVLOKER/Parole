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
		<title>Changer votre mot de passe</title>

		
		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>		

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/motdepasse.css">


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
			<h2>Changement de mot de passe</h2>
			<div class="pp" > 



<?php


require 'DB_config.php';
	if(isset($_POST['a_password']) && isset($_POST['n_password']) && isset($_POST['c_password'])){
		if ($_POST['n_password']==$_POST['c_password']) {
					$requet = "SELECT password FROM user WHERE id = '".$_SESSION['id']."' AND  password = '".$_POST['a_password']."' ";
					$stmt = $conn->prepare($requet);
					$stmt->execute();
						if ($stmt->rowCount() > 0) {
							$requet = "UPDATE user SET password= '".$_POST['n_password']."' WHERE id = '".$_SESSION['id']."' ";
							$stmt = $conn->prepare($requet);
							$stmt->execute();

							echo('<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong><i class=" 	fas fa-exclamation-circle" ></i></strong> Votre Mot de passe est changé avec Succès. 
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');								

								$href = "#";
								if($_SESSION['type']==1) $href = "Admin_Gestion.php";
								else $href = "User_Demande.php";
								
								echo ('
								<script type="text/javascript">
										setTimeout(function(){ 
											window.location.href = "'.$href.'";
										}, 3000);
								</script>');
								
						}else{

							echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
								  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Vérifier l\'ancien mote de passe. 
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>');

							}
						}else{

						echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Les deux mots de passe ne sont pas identiques. 
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>');

						}

	}else{
		//echo "isset !!!!!";
	}					
		
//print_r($_POST);

?>

		<center><div class="change_pass" >
			<h1><i class="fas fa-user-lock" ></i> Changer votre mot de passe </h1>
			<p>
				<form action="changer_Pass.php" method="post">

					<span class="fa fa-fw fa-lock field-icon pw" style="color:#d9190c;"></span>
					<input type="password" name="a_password" placeholder="Ancien mot de passe" id="a_password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

					<span class="fas fa-lock pw" style="color:#218838"></span>
					<input type="password" name="n_password" placeholder="Nouveau mot de passe" id="n_password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

					<span class="fas fa-lock pw" style="color:#218838" ></span>
					<input type="password" name="c_password" placeholder="Confirmer le mot de passe" id="c_password" required>
					<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					<center>
					<table border="0" class="chg_anul" cellpadding="5" >
						<tbody>
							<tr>
								<td>
									<button type="submit" class="btn btn-success  btn-block submit"> <i class="far fa-check-circle" ></i> Changer</button>
								</td>
								<td>
									<a href="javascript:history.back()" class="btn btn-secondary btn-block" role="button"><i class="fas fa-ban" ></i> Annuler</a>
								</td>
							</tr>
						</tbody>
					</table>
					</center>
				</form>
			</p>
			</div></center>
			</div>
		</div>

	</body>
</html>
