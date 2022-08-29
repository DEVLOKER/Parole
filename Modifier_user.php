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
		<title>Modéfier un compte</title>

		
		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>		

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/modifieruser.css">


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
			<h2>Modification d'un compte</h2>
			<div class="pp" > 



<?php

	include 'user.php';


	$user_ = array(); $vide = '""';

	/*$user_['id'] = $_POST['id'];
	$user_['service'] = $_POST['service'];
	$user_['username'] = $_POST['username'];
	$user_['password'] = $_POST['password'];
	$user_['type'] = $_POST['user_type'];*/

	$user_['id'] = $vide;
	$user_['service'] = $vide;
	$user_['username'] = $vide;
	$user_['password'] = $vide;
	$user_['type'] = $vide;	


	$disabled = "disabled";
	$compte ='Modifier Un compte';
	
	if( isset($_POST['id']) && isset($_POST['service']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_type'])){

		$more_than_one_admin = modifierUser($_POST['id'], $_POST['service'], $_POST['username'], $_POST['password'], $_POST['user_type']);

		if(!$more_than_one_admin){

					  echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Impossible de modifier le dernier compte Administrateur  <b>"'.$_POST['service'].'"</b>!
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
				  <strong><i class="fas fa-exclamation-circle" ></i></strong> Compte "'.$_POST['service'].'" est modifier avec succès. 
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


						
	}else{
		//echo " not POST <br>";
	}					


	if(isset($_GET['id'])){
		$user_ = readUser($_GET['id']); 

	$user_['id'] = '"'.$user_['id'].'"';
	$user_['service'] = '"'.$user_['service'].'"';
	$user_['username'] = '"'.$user_['username'].'"';
	$user_['password'] = '"'.$user_['password'].'"';
	$user_['type'] = '"'.$user_['type'].'"';	

		$disabled = "";
		$compte = 'Modifier le compte du <b>'.$user_['service'].'</b>';
	}else{
		//echo " not GET <br>";
	}

	//print_r($user_);

?>

		<center><div class="update" >

			<h1><i class="fas fa-pencil-alt fa-1x" ></i> <?php echo $compte; ?></h1>
			<p>
				<form action="Modifier_user.php" method="post">

					<label for="id"></label>
					<input type="text" name="id" placeholder="ID utilisateur" value=<?php echo $user_['id'];?> id="id" readonly required>

					<label for="service"></label>
					<input type="text" name="service" placeholder="Service" value=<?php echo $user_['service'];?> id="service" required>
					

					<label for="username"></label>
					<input type="text" name="username" placeholder="Nom d'utilisateur" value=<?php echo $user_['username'];?> id="username" required>
					

					<label for="password"></label>
					<input type="password" name="password" placeholder="Mot de passe" value=<?php echo $user_['password'];?> id="password" required>
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
									<button type="submit" class="btn btn-success  btn-block submit" <?php echo $disabled; ?> ><i class="far fa-check-circle" ></i> Modifier</button>
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
