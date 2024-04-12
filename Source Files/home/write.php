<?php
	session_start();
	$message = $_REQUEST["message"];
	if ((trim($message) != "") & ((strpos($message, "<")) == false) & ((strpos($message, ">")) == false)) {
		$email = $_SESSION["email"];
		$contact = $_SESSION["contact"];
		if ($email<$contact)
			$myfile = "o0zTrb0aOJwsnQLV/".$email." - ".$contact;
		else 
			$myfile = "o0zTrb0aOJwsnQLV/".$contact." - ".$email;
		if (file_exists($myfile) != true) {
			$file = fopen($myfile, "w");
			fwrite($file, "<?php header('Location: http://david.bartok.ro'); ?>\n");
			fclose($file);
		}
		file_put_contents($myfile, "<".$email.">\n".$message."\n", FILE_APPEND);
		echo "<script>document.getElementById('messages').innerHTML += '<div class=margin><div class=message id=right>".trim($message)."</div></div></div>';</script>";
		echo "<script>document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;</script>";
	}
	echo "<script>document.getElementById('textbox').value = '';</script>";
?>