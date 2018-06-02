<?php

get_function('create_cfg');

$smarty->assign('rand_name', mt_rand(0000000000, 9999999999));

if(isset($_POST['submit'])){
		$FORM_BAD = 1;
	}else{
			$FORM_BAD = 1;
		}
	}

	if(empty($_POST['ip'])){
		$bad_form['ip'] = '"' . $lang['ip'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}else{
		if(strlen($_POST['ip']) > 20){
			$bad_form['ip'] = $lang['nbpi'];
			$FORM_BAD = 1;
		}elseif(!preg_match('~^([0-9.]+)$~', $_POST['ip'])){
			$FORM_BAD = 1;
		}else{

			$test = true;
			foreach($ip as $t){
					break;
				}
			}

			if($test != true){
            	$bad_form['ip'] = $lang['nbpi'];
				$FORM_BAD = 1;
			}
		}
	}

	if(empty($_POST['port'])){
		$bad_form['port'] = '"' . $lang['port'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}else{
		if(strlen($_POST['port']) > 5){
			$bad_form['port'] = $lang['nbpp2'];
			$FORM_BAD = 1;
		}elseif($_POST['port'] > 65536 && $_POST['port'] < 0){
			$FORM_BAD = 1;
		}
	}

	if(empty($_POST['ca'])){
		$bad_form['ca'] = '"' . $lang['ca'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}

	if(empty($_POST['crt'])){
		$bad_form['crt'] = '"' . $lang['crt'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}

	if(empty($_POST['key'])){
		$bad_form['key'] = '"' . $lang['key'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}
    /*
	if(empty($_POST['ta'])){
		$bad_form['ta'] = '"' . $lang['ta'] . '" ' . $lang['nbp'];
		$FORM_BAD = 1;
	}
    */
	if($FORM_BAD <> 1){
		// SELECT MAX(prio)+1, concat('".$_POST['name']."'), concat('".$_POST['protocol']."'), concat('".$_POST['ip']."'), concat('".$_POST['port']."'), concat('".$_POST['ca']."'), concat('".$_POST['crt']."'), concat('".$_POST['key']."'), concat('".$_POST['ta']."'), concat('".base64_encode($_POST['cfg'])."'), concat('".$_POST['enable']."') FROM bf_servers LIMIT 1
		$insert_id = $mysqli->query("INSERT INTO bf_servers (`prio`, `name`, `protocol`, `ip`, `port`, `ca`, `crt`, `key`, `ta`, `cfg`, `enable`) SELECT MAX(prio)+1, concat('".$_POST['name']."'), concat('".$_POST['protocol']."'), concat('".$_POST['ip']."'), concat('".$_POST['port']."'), concat('".$_POST['ca']."'), concat('".$_POST['crt']."'), concat('".$_POST['key']."'), concat('".$_POST['ta']."'), concat('".base64_encode($_POST['cfg'])."'), concat('".$_POST['enable']."') FROM bf_servers LIMIT 1");
		//$insert_id = $mysqli->query("INSERT INTO bf_servers (`name`, `protocol`, `ip`, `port`, `ca`, `crt`, `key`, `ta`, `cfg`, `enable`) VALUES ('".$_POST['name']."', '".$_POST['protocol']."', '".$_POST['ip']."', '".$_POST['port']."', '".$_POST['ca']."', '".$_POST['crt']."', '".$_POST['key']."', '".$_POST['ta']."', '".base64_encode($_POST['cfg'])."', '".$_POST['enable']."')");
		if($insert_id == false){
		}else{
            create_cfg($_POST);
			$smarty->assign("save", true);
		}
	}else{
		if(count($bad_form) > 0){
			rsort($bad_form);
			for($i = 0; $i < count($bad_form); $i++){
				if ( $i & 1 ) $value_count = "1"; else $value_count = "2";
				$errors .= '<div class="t"><div class="t4" align="center">' . $bad_form[$i] . '</div></div>';
			}
		}
	}
	$smarty->assign("errors", $errors);
}

?>