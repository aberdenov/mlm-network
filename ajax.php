<?php
	define("IN_SITEDRIVE", 1);
	
	# INCLUDES ##############################################################################
	
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");
	
	# MAIN ##################################################################################
	
	if (isset($_POST['type'])) {
		if ($_POST['type'] == "html-request") {
			
			if ($_POST['action'] == 1) {
				$out = '';

				getStruct($_POST['user_id'], 0);

				print_r($out."#".$_POST['user_id']);
			}
			
		}
	} 	
?>
