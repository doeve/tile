<?php
  $email = $_REQUEST["email"];
  $passw = $_REQUEST["passw"];
  $user = $_REQUEST["user"];
  if (((trim($email) != "") & ((strpos($email, "<")) == false) & ((strpos($email, ">")) == false)) & ((trim($passw) != "") & ((strpos($passw, "<")) == false) & ((strpos($passw, ">")) == false))  & ((trim($user) != "") & ((strpos($user, "<")) == false) & ((strpos($user, ">")) == false))) {
    $myfile = file_get_contents("database.php");
    if (strpos($myfile, $email) == false){
      $file_main = fopen("database.php", "a");
      fwrite($file_main, $email." ".$passw." ".$user."\n");
      fclose($file_main);
      $file_eu = fopen("home/database.php", "a");
      fwrite($file_eu, $email." ".$user."\n");
      fclose($file_eu);
      echo "<script>register_success()</script>";
    } else {
      echo "<script>register_failed()</script>";
    }
  }
?>