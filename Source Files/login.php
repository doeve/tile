<?php session_start()?>
<?php
  $email = $_REQUEST['email'];
  $passw = $_REQUEST['passw'];
  if (((trim($email) != "") & ((strpos($email, "<")) == false) & ((strpos($email, ">")) == false)) & ((trim($passw) != "") & ((strpos($passw, "<")) == false) & ((strpos($passw, ">")) == false))) {
    $file = file_get_contents('database.php');
    $verify = $email . " " . $passw." ";
    if (strpos($file, $verify) == true){
      echo "<script>login_success();</script>";
      $_SESSION["email"] = $email;
    } else {
    echo "<script>login_failed();</script>";
    }
  }
?>

