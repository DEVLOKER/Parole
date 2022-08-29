<?php 
			session_start();
			require 'Demande.php';
			
			supprimerDemande($_SESSION['id']);

			header('Location: User_Demande.php');
?>