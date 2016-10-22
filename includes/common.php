<?php
	// Отображаем сообщение о проделанной операции
	function showResult($text, $css_class) {
		$result = '<div class="'.$css_class.'" align="center">'.$text.'</div>';
		return $result;
	}

	function crypt_string($str, $encrypt = true) {
		if ($encrypt) {
			$crypt_str = base64_encode($str);
			$crypt_str = urlencode($crypt_str);
			return $crypt_str;
		} else {
			$str = urldecode($str);
			$crypt_str = base64_decode($str);
			return $crypt_str;
		}
		return 0;
	}

	function pageReload($params = '') {
		if (empty($params)) {
			header("Location: ".$GLOBALS['_SERVER']["REQUEST_URI"]);
			exit;
		}
		
		$pos      = strpos($params, "#");
		$fragment = substr($params, $pos, strlen($params)-$pos);
		$params   = str_replace($fragment, "", $params);
		
		parse_str($GLOBALS['_SERVER']["QUERY_STRING"], $url_params);
		parse_str($params, $str_params);
		
		foreach ($url_params as $key => $val) {
			if (isset($str_params[$key])) {
				$url_params[$key] = $str_params[$key];
				unset($str_params[$key]);
			}
		}
		
		$param_array = array_merge($url_params, $str_params);
		
		$url = "";
		$i = 0;
		$count = count($param_array);
		
		foreach ($param_array as $key => $val) {
			$i++;
			$url.= $key."=".$val;
			if ($i < $count) $url.= "&";
		}
		
		$url = SITE_URL."?".$url.$fragment;
		
		header("Location: ".$url);
		exit;
	}

	function validateFileType($type) {
		switch ($type) {
			case 'image/gif': return 'gif'; break;
			case 'image/bmp': return 'bmp'; break;
			case 'image/pjpeg': return 'jpg'; break;
			case 'image/jpeg': return 'jpg'; break;
			case 'image/jpg': return 'jpg'; break;
			case 'image/x-png': return 'png'; break;
			case 'image/png': return 'png'; break;
			case 'application/x-shockwave-flash': return 'swf'; break;
		}
		return false;
	}

	function generatePassword($length) {
		$min = $length;   
		$max = $length;   
		$pwd = ''; 		  
		
		for ($i = 0; $i < rand($min, $max); $i++) {
			 $num = rand(48, 122);
			 if (($num > 97 && $num < 122)) {
				 $pwd.= chr($num);
			 } else if (($num > 65 && $num < 90)) {
				 $pwd.= chr($num);
			 } else if (($num > 48 && $num < 57)) {
				 $pwd.= chr($num);
			 } else if ($num == 95) {
				 $pwd.= chr($num);
			 } else {
			 	$i--;
			 }
		}
		
		return $pwd;
	}

	function getStruct($user_id, $show_title) {
		global $out;

		// Первый пользователь
		$username = db_get_data("SELECT name FROM users WHERE id = ".$user_id, "name");
		
		if ($show_title == 1) $out .= '<li>Вы<br><img src="images/human.png" class="im1"><br>'.$username;
			else $out .= '<li><img src="images/human_active.png" class="im1"><br>'.$username;

		// первая вложенность
		$eticket = db_get_data("SELECT code FROM codes WHERE user_id = ".$user_id, "code");
		$result = db_query("SELECT * FROM users WHERE eticket = '".$eticket."' LIMIT 2");
		if (db_num_rows($result) > 0) {
			$out .= '<ul>';

			while ($row = db_fetch_array($result)) {
				$out .= '<li><a href="javascript:void(0);" onclick="showStruct(\''.$row['id'].'\');"><img src="images/human.png" class="im1"></a><br><a href="show_profile.php?user_id='.$row['id'].'" class="ln1">'.$row['name'].'</a>';

				// вторая вложенность
				$eticket2 = db_get_data("SELECT code FROM codes WHERE user_id = ".$row['id'], "code");
				$result2 = db_query("SELECT * FROM users WHERE eticket = '".$eticket2."' LIMIT 2");
				if (db_num_rows($result2) > 0) {
					$out .= '<ul>';

					while ($row2 = db_fetch_array($result2)) {
						$out .= '<li><a href="javascript:void(0);" onclick="showStruct(\''.$row2['id'].'\');"><img src="images/human.png" class="im1"></a><br><a href="show_profile.php?user_id='.$row2['id'].'" class="ln1">'.$row2['name'].'</a>';
					}

					$out .= '</ul>';
				}

				$out .= '</li>';
			}

			$out .= '</ul>';
		}

		$out .= '</li>';
	}
?>