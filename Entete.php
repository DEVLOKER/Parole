	<center id="myheader" >
		<nav class="navtop">
			<div>
				<!-- <img src="img/download.png" width="100" height="65" style="margin-top: -5px; border: 1px solid #fff;" > -->
				<i class="fa fa-microphone" style="color: #fff; font-size: 40px; margin-top: 10px;" ></i>
				&nbsp;&nbsp; <h1>Gestion des demanades Parole</h1>

<?php

//try { session_start(); } catch (Exception $e) { }


if (isset($_SESSION['loggedin'])) {

			$href = "#";
			if($_SESSION['type']==1) $href = "Admin_Gestion.php";
			else $href = "User_Demande.php";

			echo ('<a href="'.$href.'"><i class="fas fa fa-user"></i>'.$_SESSION['service'].'</a>');

			if($_SESSION['type']==1) 
			echo ('<a href="Gestion_Comptes.php"><i class="fas fa-cog"></i>Gestion des comptes</a>');
?>

				
				<a href="changer_Pass.php"><i class="fas fa-user-lock" ></i>Changer le mot de passe</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Déconnecter</a>

<?php } ?>
				
			</div>
		</nav>
</center>