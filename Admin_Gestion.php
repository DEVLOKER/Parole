<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();

}
	require 'Demande.php';
?>



<!DOCTYPE html>
<html>
	<head>
	    <!--<meta http-equiv="refresh" content="2">-->
		<meta charset="utf-8">
		<title>Gestion des demandes</title>

		<script type="text/javascript" src="jquery/jquery-3.3.1.js" ></script>
		<script type="text/javascript" src="jquery/jquery-ui.js" ></script>
		<script type="text/javascript" src="js/bootstrap.js" ></script>		

		<link rel="stylesheet" href="css/entete.css" type="text/css">
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/admin.css">
		
		<link rel="icon" href="img/Parole.ico" type="image/x-icon" />

		<style>
			.navtop p.logo {
				background-color: #fff;
				background-image: url("./img/logo-128x128.png");
				background-repeat: no-repeat;
				background-size: cover; /*auto*/
				background-position: center;
				width: 45px; height:45px; margin: 0px 20px 0px 0px; margin-top: 8px;
				padding: 4px; border-radius: 15px;
				animation: zoom-in-zoom-out 1s ease infinite;
			}

			@keyframes zoom-in-zoom-out {
				0% {
					transform: scale(1, 1);
				}
				50% {
					transform: scale(1.1, 1.1);
				}
				100% {
					transform: scale(1, 1);
				}
			}
		</style>

		<script type="text/javascript">
	
			var nb_client = 0;

			$(function(){
			
				refresh ();

			});

			function refresh () {
				
				nb_client = $("#block .alert").length;
				
				$.get( "refresh_admin.php", function( data ) {
					var block = JSON.parse(data);

					var time=block["time"];
					if(block["nb_server"]!=nb_client)
						$("#block").html(block["blockHTML"]);

					$("#td").html("Nombre total des demandes : "+block["nb_server"]);
					$(".appel_encours").find(".time").html(time);

					//$('#block ').sortable({cursor: "move"});
				});			
				
				setTimeout(refresh , 1000);
			}


			</script>	
	</head>
	<body class="loggedin">
		<?php
		require 'Entete.php';
		?>
		<div class="content">
			<h2>Gestion des demandes</h2>
			<div class="pp" > 

			<div id="compter" ></div>

				<div class="alert alert-info alert-dismissible fade show" role="alert">
				  	<strong id="td" >  </strong> 
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				   		<span aria-hidden="true">&times;</span>
				    </button>
				</div>
				<hr>
				<br></br>
				
				<div id='block' ></div>	

			</div>
		</div>


	</body>
</html>
