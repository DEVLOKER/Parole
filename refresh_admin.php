<?php
	session_start();
	require 'Demande.php';



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

					$List_de_Demandes=List_Demandes();

					$block =array("nb_server" => '', "time"=> '', "blockHTML" => '');
					$block["nb_server"]  = count($List_de_Demandes); //countAll()
					$block["time"] = -1; 	

					foreach ($List_de_Demandes as $tmp_array) {

						$debut_time = date('H:i:s', strtotime($tmp_array['date_time']));	

						$etat = $tmp_array['etat'];
						$class_css = "alert-info";
						$message = 'est demandé la parole à';
						$btn_donner_parole = '';
						$btn_plus_tard = 'Plus tard';
						
						$debut_date = strtotime($tmp_array['date_time']);
						$fin_date   = strtotime(date('Y-m-d H:i:s'));
						

						$diff  = $debut_time ;
						if($etat==3){
							$class_css = "alert-info appel_encours";
							$message = 'appel en cours... <i class="fas fa-phone-volume" ></i><i class="fas fa-user" ></i>';
							$btn_donner_parole = "hidden";// disabled
							$btn_plus_tard = 'Fin d\'appel';
							$diff = calcule_time($debut_date, $fin_date);
							$block["time"] = $diff;	
						}
						

$block["blockHTML"] .= '
		<div class="alert '.$class_css.' fade show"role="alert">
					  <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>-->
					  <h6 class="alert-heading"><i class="fas fa-user-tie fa-1x" ></i> <strong>'.$tmp_array['username'].'</strong> </h6>
					   <hr>

					   <h6 class="alert-heading justify"><strong> '.$tmp_array['username'].',</strong> 
					   '.$message.' <span class="time"> '.$diff.'</span> </h6>
					   		
					   <center >
							<div class="acc_ref" >
							   <a href="Donner_parole.php?id_user='.$tmp_array['id_user'].'" '.$btn_donner_parole.' class="btn btn-success btn-sm"><i class="far fa-check-circle" ></i> Donner la parole</a>
							   <a href="Plus_tard.php?id_user='.$tmp_array['id_user'].'"  class="btn btn-danger btn-sm "><i class="fas fa-ban" ></i> '.$btn_plus_tard .'</a>
							</div>   
					   </center>  
 
		</div>
	';

					}
	
	echo ( json_encode($block) );

	//echo ( $block );

?>