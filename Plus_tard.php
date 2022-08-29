<?php 
			session_start();
			require 'Demande.php';

if(isset($_GET['id_user'])) {

			
			supprimerDemande($_GET['id_user']);
			header('Location: Admin_Gestion.php');
} else {

}
?>