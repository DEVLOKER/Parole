<?php 
			session_start();
			require 'Demande.php';
			$d = date('Y-m-d H:i:s');
			ajouterDemande($_SESSION['id'], $d, 2);

			header('Location: User_Demande.php');


?>