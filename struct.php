<?php
	require_once("./includes/db_init.php");
	require_once("./includes/common.php");

	session_start();

	# VARS ####################################################################################

	$out = '';

	# MAIN #######################################################################################

	if (isset($_SESSION['id'])) {
		require_once ("includes/template.php");

		$tpl = new FastTemplate('./templates/');
		
		$tpl->define(array(
				"struct" => "struct.tpl",
		));

		$data = db_get_data("SELECT * FROM users WHERE id = ".$_SESSION['id']);

		$programs_list = '';
		$result = db_query("SELECT * FROM programs");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				if ($row['id'] == $data['program']) $programs_list .= '<span style="color: #ff0000">'.$row['name'].'</span>&nbsp&nbsp&nbsp';
					else $programs_list .= $row['name']."&nbsp&nbsp&nbsp";
			}
		}
		$tpl->assign("PROGRAMS", $programs_list);

		// генерируем структуру 
		getStruct($_SESSION['id'], 1);

		$tpl->assign("STRUCT", $out);

		$tpl->parse("FINAL", "struct");
		$tpl->clear_unassigned_tags();

		$tpl->FastPrint();
	} else {
		header("Location: login.php");
		exit;
	}	
?>
