<?php
	session_start();
	$email = $_SESSION["email"];
	$contact = "";
	if (isset($_SESSION["contact"]))
		$contact = $_SESSION["contact"];
	if ($email<$contact)
		$myfile = "o0zTrb0aOJwsnQLV/".$email." - ".$contact;
	else 
		$myfile = "o0zTrb0aOJwsnQLV/".$contact." - ".$email;
	if (file_exists($myfile)) {
		if (isset($_SESSION["last_changed"]) == false)
			$_SESSION["last_changed"] = filemtime($myfile);
		
		if ($_SESSION["last_changed"] != filemtime($myfile)) {
			$file = fopen($myfile, "r");
			$skip = fgets($file);
			while(! feof($file)) {
				$try = fgets($file);
				if (strpos($try, "@") == true)
					$sender = $try;
				if (!feof($file))
					$message = fgets($file);
			}
			if (strpos($sender, $contact)){
				echo "<script>document.getElementById('messages').innerHTML += '<div class=margin><div class=message id=left>".trim($message)."</div></div></div>';</script>";
				echo "<script>document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;</script>";
			}
		}
		$_SESSION["last_changed"] = filemtime($myfile);
	}
?>

