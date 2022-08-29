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
		<title>Gestion des Comptes</title>

		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		
		<link rel="stylesheet" href="css/compte.css">
				

	
	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content" style="width: 95%;" >
			<h2>Gestion des Comptes</h2>
		
		<div class="pp" > 

  <a class="btn btn-success" style="float: right" href="Ajouter_user.php">
	<span class='fas fa-user-plus' aria-hidden='true'></span>
  	Ajouter Nouveau Compte
  </a>
  <br><br>

<?php

include 'pagination.php';
include 'user.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$pagination = new Pagination("Gestion_Comptes.php", $page);

$records_per_page = $pagination->records_per_page;
$from_record_num = ($records_per_page * $page) - $records_per_page;

$users = List_Users($from_record_num, $records_per_page);

$num = count($users);

if($num>0){
echo '
<table class="table " cellspacing="0" width="100%" id="usersTab" >
 <thead class="thead-dark" >
  <tr>
          <th>N°</th>
          <th>Service</th>
          <th>Nom d\'utilisateur</th>
          <th>Mot de passe</th>
          <th>Type d\'utilisateur</th>
		  <th>Action</th>			  
    </tr>
 </thead>
 <tbody>

	';


	foreach ($users as $tmp_array) {
			$id_ = $tmp_array['id'];
			  echo "<tr>";	
			  echo "<td>".$tmp_array['id']."</td>";
			  echo "<td>".$tmp_array['service']."</td>";
			  echo "<td>".$tmp_array['username']."</td>";
			  echo "<td>".$tmp_array['password']."</td>";
			  echo "<td>".($tmp_array['type']==0 ? 'Utilisateur Simple' : 'Administrateur')."</td>";
			  //echo "<td>".$tmp_array['type']."</td>";
			echo "<td width='80px'>
			 <!--<a title='Detail' href='detail.php?id={$id_}&page={$page}' ><span class='fas fa-eye fa-1x' aria-hidden='true'></span> </a>-->
		     <a title='Modifier' class='modifier' href='Modifier_user.php?id={$id_}' role='button'><span class='fas fa-pencil-alt fa-1x' aria-hidden='true'></span></a>
		     <a title='Supprimer' class='supprimer' href='supprimer_user.php?id={$id_}' role='button'><span class='fas fa-trash fa-1x' aria-hidden='true'></span></a>      
				 </td></tr>";
	}

echo " </tbody>
      </table>";


	$pagination->paginate(countAll());

}else{
echo '
<br></br>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
  <strong><span class="glyphicon glyphicon-alert" aria-hidden="true"></span></strong> Aucun compte n\'a ete trouvé!
</div>
';
}

?>
		</div>
	</body>
</html>