<?php
  	session_start();
	$user = $_REQUEST['user'];
	$contact = $_REQUEST['email'];
	$email = $_SESSION["email"];
	$_SESSION["contact"] = $contact;
	echo "<script>transform_main();</script>";
	echo "<script>document.getElementById('header_user').innerHTML = '".$user."';</script>";
	echo "<script>document.getElementById('header_email').innerHTML = '".$contact."';</script>";
	if ($email<$contact) {
		$myfile = "o0zTrb0aOJwsnQLV/".$email." - ".$contact;
	} else {
		$myfile = "o0zTrb0aOJwsnQLV/".$contact." - ".$email; }
	if (file_exists($myfile) == true) {
		$file = fopen($myfile, "r");
		while(! feof($file)) {
			$line = fgets($file);
			if (strpos($line, $email) != false) {
				$nline = fgets($file);
				echo "<script>document.getElementById('messages').innerHTML += '<div class=margin><div class=message id=right>".trim($nline)."</div></div></div>';</script>";
			}
			if (strpos($line, $contact) != false) {
				$nline = fgets($file);
				echo "<script>document.getElementById('messages').innerHTML += '<div class=margin><div class=message id=left>".trim($nline)."</div></div></div>';</script>";
			}
		}
		echo "<script>document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;</script>";
		unset($_SESSION["last_changed"]);
	}
?>

