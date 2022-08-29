<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();

}

function calcule_time($debut_date, $fin_date){

	$diff  = abs($fin_date - $debut_date);
	$sec = $diff % 60;
	if ($sec<10) $sec="0".$sec;
	$min = (floor($diff-$sec)/60)%60;
	if ($min<10) $min="0".$min;
	$hrs = (floor((floor($diff-$sec)/60)-$min)/60)%24;
	if ($hrs>0){
		if ($hrs<10){$hrs="0".$hrs.':';}
		else $hrs=$hrs.':';
	}
	else $hrs='';

	$diff = $hrs.''.$min.':'.$sec;
	
	return $diff;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<!--<meta http-equiv="refresh" content="2">-->
		<meta charset="utf-8">
		<title>Demande</title>

		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>

		<link href="css/entete.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link href="jquery/jquery-ui.css" rel="stylesheet" type="text/css">
		
	<script type="text/javascript">
	
		var an_etat = -1;
		var nb_new_etat= -1;
			
	$(function(){

		refresh ();

	});

			function refresh () {

	
				$.get( "refresh_user.php", function( data ) {
					
					//$("#block").html(data);

					var block = JSON.parse(data);

					var time=block["time"];
					
					nb_new_etat=block["etat"];

						$(".alert").find(".time").html(time);
					if(nb_new_etat!=an_etat){
						an_etat=nb_new_etat;
								$("#block").html(block["blockHTML"]);
					}
				});	
						
				setTimeout(refresh , 1000);
			}

	</script>		
		
	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content" style="width:95%" >
			<h2>Demande de la parole</h2>
		<br>
		<div class="pp" id="block" >
				


		</div>
	</div>

	</body>
</html>