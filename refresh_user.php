<?php
	session_start();
	require 'Demande.php';

		$demande = readDemande($_SESSION['id']);
		$diff = "";
		$etat = null;
		if(count($demande)>0){ 
			$debut_date = strtotime($demande['date_time']);
			$fin_date   = strtotime(date('Y-m-d H:i:s'));
			$diff = calcule_time($debut_date, $fin_date);

			$etat = $demande["etat"];
		}
		$block =array("etat" => '', "time"=> '', "blockHTML" => '', "count" => '');
	    //$block["count"] = $demande["count"];
		$block["etat"] = $etat;
		$block["time"] = $diff;	
		$block["blockHTML"] .= messageEtat($etat, $diff);
		$block["blockHTML"] .='<hr><br><center>'.buttonEtat($etat).'</center>';
		
	
	echo ( json_encode($block) );

	//echo ( $block );



	// ###################################### calcule_time #####################################


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

	// ###################################### Messages #####################################

function messageEtat($etat, $diff){

	$msg1 =  '
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong> '.$_SESSION['username'].' </strong>, désactiver votre microphone S.V.P. <i class="fa fa-microphone-slash" ></i>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	';

	$msg2 = '
		<div class="alert alert-warning fade show" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		  <h4 class="alert-heading"><strong>'.$_SESSION['username'].'</strong> </h4>
		   <hr>
		  <p>Votre demande est encours... <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i> <!--<i class="fas fa-circle-notch fa-spin fa-1x"></i>--> </p>
		  <p class="mb-0">patienter votre tour S.V.P. 
		</div>
	';

	$msg3 =  '
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>'.$_SESSION['username'].'</strong>, appel en cours... <span style="animation: zoom-in-zoom-out 1s ease infinite;" ><i class="fas fa-phone-volume" ></i><i class="fas fa-user" ></i></span> <span class="time"> '.$diff.'</span> </p>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	';

	$msg4 = '
		<div class="alert alert-secondary fade show" role="alert">
		  <strong>'.$_SESSION['username'].'</strong>, opération términée avec sucsès. <i class="fas fas fa-check" ></i>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	';

		switch ($etat) {
		    case 1:
		    	return $msg1;
		        break;
		    case 2:
				return $msg2;
		        break;
		    case 3:
		    	return $msg3;
		        break;
		    case 4:
		    	return $msg4;
		        break;
		    default:
		    	return $msg1;
		        break;
		}

}

	// ###################################### Buttons #####################################

function buttonEtat($etat){
	
	$damande = "";
	$Annuler = "";
	switch ($etat) {
		    case 1:
		    	$damande = "";
		    	$Annuler = "disabled";
		        break;
		    case 2:
		    	$damande = "disabled";
		    	$Annuler = "";
		        break;
		    case 3:
		    	$damande = "disabled";
		    	$Annuler = "disabled";
		        break;
		    case 4:
		    	$damande = "disabled";
		    	$Annuler = "disabled";
		        break;
		    default:
		    	$damande = "";
		    	$Annuler = "disabled";
		        break;
		}

$form = '	<table border="0" cellpadding="10" >
					<tbody>
						<tr>
							<td>
				<form action="ajouter_demande.php" method="post">
					<button '.$damande.' type="submit" class="btn btn-success">Demander la parole <i class="fa fa-microphone" ></i></button>
				</form>
							</td>
							<td>
				<form action="annuler_demande.php" method="post">
					<button '.$Annuler.' type="submit" class="btn btn-danger">Annuler la demande <i class="fas fa-ban" ></i></button>
				</form>
							</td>
						</tr>
					</tbody>
			</table>
';

		
	return $form ;
		}	



?>