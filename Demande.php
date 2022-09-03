<?php

	

  
	// ###################################### ajouterDemande #####################################
	 function ajouterDemande($id_user, $date_time, $etat){
	   	  require 'DB_config.php';
		  $requet = "INSERT INTO demandes values('".$id_user."', '".$date_time."', '".$etat."' )";
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
	   	  
	 }
  
	// ###################################### modifierDemande #####################################
	 function modifierDemande($id_user, $etat){
	 	$d = date('Y-m-d H:i:s');
	 	  require 'DB_config.php';
		  $requet = "UPDATE demandes 
					 SET etat = '".$etat."' ,  
					 date_time = '".$d."' 
					 WHERE id_user = '".$id_user."'";

		  $stmt = $conn->prepare($requet);
		  $stmt->execute();

	 }
	  
	 // ###################################### supprimerDemande #####################################
	 function supprimerDemande($id_user){
	 	  require 'DB_config.php';
		  $requet = "DELETE FROM demandes 
		  			 WHERE id_user = '".$id_user."'";

		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
	 }
	 // ###################################### supprimer_etat_3 #####################################
	 function supprimer_etat_3(){
	 	  require 'DB_config.php';
		  $requet = "DELETE FROM demandes 
		  			 WHERE etat = '3'";

		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
	 }
 	// ###################################### List_Demandes #####################################
	 function List_Demandes(){

	 	  require 'DB_config.php';
		$list = array();	

		  $requet = " (SELECT * 
					FROM demandes, user 
					WHERE id_user = id 
					AND demandes.etat = 3 
					ORDER BY date_time ASC )
					UNION 
					(SELECT * 
					FROM demandes, user 
					WHERE id_user = id 
					AND demandes.etat = 2 
					ORDER BY date_time ASC )
					";
		   
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		  
			
			while($row = $stmt->fetch()) {
			  $tmp_array = array();
			  $tmp_array['id_user'] = $row['id_user'];
			  $tmp_array['date_time'] = $row['date_time'];
			  $tmp_array['etat'] = $row['etat'];
			  $tmp_array['service'] = $row['service'];
			  $tmp_array['username'] = $row['username'];
			  array_push($list,$tmp_array);
			}
		   
		  return $list;
	 }
	

 	// ###################################### countAll #####################################
	 function countAll(){
	   	  require 'DB_config.php';
		  $requet = "SELECT id_user FROM demandes ";
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		   
		  $num = $stmt->rowCount();
		   
		  return $num;
	 }

 	// ###################################### readDemande #####################################
	 function readDemande($id_user){
	 	  require 'DB_config.php';
		  $requet = "SELECT *
					FROM demandes 
					WHERE id_user = '".$id_user."'";
			
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();

			$tmp_array = array();// array("count" => '', "id_user"=> '', "date_time" => '', "etat" => '');
			
			while($row = $stmt->fetch()) {
			  //$tmp_array['count'] = $stmt->rowCount();
			  $tmp_array['id_user'] = $row['id_user'];
			  $tmp_array['date_time'] = $row['date_time'];
			  $tmp_array['etat'] = $row['etat'];
			}

		  //return $stmt->rowCount(); 
		  return $tmp_array;
	 }

/*
 	// ###################################### Action #####################################

	if( isset($_GET['action'])){

		$action = $_GET['action'];

		switch ($action) {
		    case "ajouter":
		    	$demande = readDemande($_SESSION['id']);
		    	if(count($demande)==1){
		    		ajouterDemande($_SESSION['id'], date('Y-m-d H:i:s'), 0);
		    		echo "0"; // not exist
		    	}else{
		    		echo "1"; // exist already
		    	}
		        break;
		    case "modifier":
				modifierDemande($_SESSION['id'], $_GET['etat']);
		        break;
		    case "supprimer":
		        supprimerDemande($_SESSION['id']);
		        break;
		    case "listDemandes":
		        $listDemandes = List_Demandes();
		        echo json_encode($listDemandes);
		        break;
		    case "countAll":
		        $num = countAll();
		        echo json_encode($num);
		        break;
		}

	}

*/

?> 