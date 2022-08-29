<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Connecter</title>
		
		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		
	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content">
			<h2>Connecter</h2>

<?php

if ( isset($_POST['username'], $_POST['password']) ) {
	
	try { session_start(); } catch (Exception $e) {}
	

	require 'DB_config.php';

		$requet = "SELECT * FROM user WHERE username = '".$_POST['username']."' AND  password = '".$_POST['password']."' ";

		$stmt = $conn->prepare($requet);

		$stmt->execute();

		if ($stmt->rowCount() > 0) {

			session_regenerate_id();

			while($row = $stmt->fetch()) {
				  $_SESSION['loggedin'] = TRUE;
				  $_SESSION['id'] = $row['id'];
				  $_SESSION['username'] = $row['username'];
				  $_SESSION['password'] = $row['password'];
				  $_SESSION['service'] = $row['service'];
				  $_SESSION['type'] = $row['type'];
			}
			
			if($_SESSION['type']==1) header('Location: Admin_Gestion.php');
			else header('Location: User_Demande.php');
			
		} else {

						echo('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation-triangle" ></i></strong> Le nom d\'utilisateur ou le mot de passe incorrect. 
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>');


						echo ('
								<script type="text/javascript">
										setTimeout(function(){ 
											window.location.href = "index.php";
										}, 3000);
								</script>');

		}

		$stmt->closeCursor();
	

}


?>
		</div>
	</body>
</html>