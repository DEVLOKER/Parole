<?php 
			session_start();
			require 'Demande.php';

if(isset($_GET['id_user'])) {

			supprimer_etat_3();


			modifierDemande($_GET['id_user'], 3);

			header('Location: Admin_Gestion.php');
} else {

}




?>