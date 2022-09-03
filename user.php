<?php

	


	// ###################################### ajouterUser #####################################
	function ajouterUser($service_, $username_, $password_, $type_){
		require 'DB_config.php';
	   	$requet = "SELECT * FROM user WHERE service = '".$service_."' OR username = '".$username_."' ";
		$stmt = $conn->prepare($requet);
		$stmt->execute();
	   	//$stmt->fetchColumn(); // num_rows
		if($stmt->fetchColumn()==0){
			$requet = "INSERT INTO user values(NULL, '".$service_."', '".$username_."', '".$password_."', '".$type_."' )";
			$stmt = $conn->prepare($requet);
			$stmt->execute();
			return 0;
		}else{
			return 1;
		}
	}
  
	// ###################################### modifierUser #####################################
	 function modifierUser($id_user_, $service_, $username_, $password_, $type_){
	 	  
	 	  $readUser_ = readUser($id_user_); $isadmin = $readUser_['type'];	
	 	  $countAdmins = countAdmins();
	 	  require 'DB_config.php';
	 	  $more_than_one_admin = true;
		  if($isadmin==1 && $type_==0 && $countAdmins ==1){
	 	  	  $more_than_one_admin = false;
	 	  }else{
			  $requet = "UPDATE user 
						 SET service = '".$service_."',  
						 	 username = '".$username_."', 
						 	 password = '".$password_."', 
						 	 type = '".$type_."'  
						 WHERE id = ".$id_user_;

			  $stmt = $conn->prepare($requet);
			  $stmt->execute();
			  //if(!$stmt->execute()) return $stmt->errorInfo();
	 	  }	  

		  return $more_than_one_admin;
	 }
	  
	 // ###################################### supprimerUser #####################################
	 function supprimerUser($id_user_){

		  $readUser_ = readUser($id_user_); $isadmin = $readUser_['type'];
		  $countAdmins = countAdmins();
		  require 'DB_config.php';
		  $more_than_one_admin = false;
		  if($isadmin==0 || $countAdmins >1){
	 	  	  $more_than_one_admin = true;	
			  $requet = "DELETE FROM user WHERE id = '".$id_user_."'";

			  $stmt = $conn->prepare($requet);
			  $stmt->execute();
			}
			return $more_than_one_admin;  
	 }

 	// ###################################### List_Users #####################################
	 function List_Users($from_record_num, $records_per_page){
	 	  require 'DB_config.php';
		  $requet = "SELECT *
					FROM user
					ORDER BY id DESC 
					LIMIT ".$from_record_num.", ".$records_per_page." ";
		   
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		  
			$list = array();
			while($row = $stmt->fetch()) {
			  $tmp_array = array();
			  $tmp_array['id'] = $row['id'];
			  $tmp_array['service'] = $row['service'];
			  $tmp_array['username'] = $row['username'];
			  $tmp_array['password'] = $row['password'];
			  $tmp_array['type'] = $row['type'];			
			  array_push($list,$tmp_array);
			}
		   
		  return $list;
	 }
	

 	// ###################################### recherche_Users #####################################
	 function recherche_Users($term, $from_record_num, $records_per_page){
	 	  require 'DB_config.php';
		  $requet = "SELECT *
					FROM user 
					WHERE id LIKE %".$term."% 
					OR    service LIKE %".$term."% 
					OR    username LIKE %".$term."% 
					OR    password LIKE %".$term."% 
					OR    type LIKE %".$term."% 
		  			ORDER BY id DESC 
		  			LIMIT ".$from_record_num.", ".$records_per_page." ";
		   
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		  
			$list = array();
			while($row = $stmt->fetch()) {
			  $tmp_array = array();
			  $tmp_array['id'] = $row['id'];
			  $tmp_array['service'] = $row['service'];
			  $tmp_array['username'] = $row['username'];
			  $tmp_array['password'] = $row['password'];
			  $tmp_array['type'] = $row['type'];			
			  array_push($list,$tmp_array);
			}
		   
		  return $list;
	 }
	
 	// ###################################### countAll #####################################
	 function countAll(){
	   	  require 'DB_config.php';
		  $requet = "SELECT id FROM user ";
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		   
		  $num = $stmt->rowCount();
		   
		  return $num;
	 }

 	// ###################################### countAdmins #####################################
	 function countAdmins(){
	   	  require 'DB_config.php';
		  $requet = "SELECT id FROM user WHERE type = '1'";
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();
		   
		  $num = $stmt->rowCount();
		   
		  return $num;
	 }

 	// ###################################### readUser #####################################
	 function readUser($id_user){
	 	  require 'DB_config.php';
		  $requet = "SELECT *
					FROM user 
					WHERE id = '".$id_user."'";
			
		  $stmt = $conn->prepare($requet);
		  $stmt->execute();

		    $tmp_array = array();
			while($row = $stmt->fetch()) {
			  $tmp_array['id'] = $row['id'];
			  $tmp_array['service'] = $row['service'];
			  $tmp_array['username'] = $row['username'];
			  $tmp_array['password'] = $row['password'];
			  $tmp_array['type'] = $row['type'];
			}

		  //return $stmt->rowCount(); 
		  return $tmp_array;
	 }

?> 