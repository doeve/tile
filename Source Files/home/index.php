<?php
  session_start();
  if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
  } else {
    header("Location: http://david.bartok.ro");
  }
  $information = array(array());
  $file = fopen("database.php","r");
  $i = 0;
  while(! feof($file)) {
    ++$i;
    $line = fgets($file);
    if ($i != 1) {
        $information[$i][1] = substr($line, 0, strpos($line, ' '));
        $information[$i][2] = trim(substr($line, strpos($line, ' ') + 1, strlen($line)));
      }
    $n=$i;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: sans-serif;
                background: #34495e;
                background: linear-gradient(45deg, #003459, #028090, #02c39a, #fce38a);
                background-size: 600% 100%;
                animation: gradient 16s ease-in-out infinite;
                animation-direction: alternate;
                transition: 0.25s;
            }

            @keyframes gradient {
                0% {background-position: 0%}
                100% {background-position: 100%}
            }

            @font-face {
                font-family: 'bebas_neueregular';
                src: url('Assets/Font/bebasneue-regular-webfont.woff2') format('woff2'),
                     url('Assets/Font/bebasneue-regular-webfont.woff') format('woff');
                font-weight: normal;
                font-style: normal;
            }

            h2 {
                line-height: 1.6;
                letter-spacing: 7px;
                font-size: 30px;
                color: white;
                font-weight: 700;
                position: absolute;
                top: 100px;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #main_page {
                background: rgba(25, 25, 25, 0.7);
                border-radius: 10px;
                padding: 60px;
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 30%;
                height: 45%;
                transition: 0.25s;
            }

            #users {
                position: absolute;
                top: 10%;
                left: 0;
                width: 100%;
                height: 85%;
                background: rgba(0, 0, 0, 0.1);
                overflow: auto;
                padding-bottom: 5px;
            }

            #user {
                width: 95%;
                height: 100px;
                background: rgba(0, 0, 0, 0.1);
                position: relative;
                border-radius: 10px;
                margin-top: 10px;
                margin-left: auto;
                margin-right: auto;
                transition: 0.25s;
            }

            #user:hover {
                transform: translate(-5px, -3px);
                background: rgba(0, 20, 0, 0.1);
                cursor: pointer;
                box-shadow: 5px 3px rgba(0, 0, 0, 0.2);;
            }

            #greeting {
                position: absolute;
                top: 1.5%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #header {
                position: absolute;
                top: 0;
                left: 0;
                height: 15%;
                color: white;
                width: 100%;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                background: rgba(0, 0, 0, 0.1);
                display: none;
            }

            #header_user {
                font-weight: 1000;
                position: absolute;
                top: 25%;
                left: 50%;
                transform: translate(-50%);
            }

            #header_email {
                position: absolute;
                bottom: 33%;
                left: 50%;
                transform: translate(-50%);
            }

            #user_name {
                font-weight: 1000;
                position: absolute;
                top: 25%;
                left: 50%;
                transform: translate(-50%);
                color: white;
            }

            #user_email {
                position: absolute;
                bottom: 33%;
                left: 50%;
                transform: translate(-50%);
                color: white;
            }

            #textpad {
                position: absolute;
                bottom: 0;
                left: 0;
                height: 8%;
                color: white;
                width: 100%;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
                background: rgba(0, 0, 0, 0.1);
                display: none;
            }

            #textbox {
                height: 40px;
                border: solid rgba(0, 0, 0, 0.5);
                position: absolute;
                top: 50%;
                left: 1%;
                border-radius: 20px;
                width: 93%;
                text-align: left;
                transform: translate(0%, -50%);
                background-color: rgba(255, 255, 255, 0.05);
                padding-left: 15px;
                color: white;
            }

            #sendable {
                position: absolute;
                top: 50%;
                right: 1%;
                height: 40px;
                width: 45px;
                border-radius: 10px;
                text-align: left;
                background: none;
                padding: 10px;
                background-image: url(sendable.png);
                background-repeat: no-repeat;
                border: none;
                background-size: 100% 100%;
                transform: translate(0, -50%);
            }

            #messages {
                position: absolute;
                top: 15%;
                left: 0;
                width: 100%;
                height: 77%;
                display: none;
                overflow: auto;
            }

            #search_element {
                background: rgba(25, 25, 25, 0.2);
                display: block;
                color: white;
                font-size: 30px;
                font-weight: 500;
                color: rgba(219, 237, 243, 0.8);
                border: 2px solid #3498db;
                outline: none;
                width: 70%;
                height: 60px;
                position: absolute;
                bottom: 100px;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 20px;
                text-align: center;
                transition: 0.25s;
            }

            #search_element:focus {
                border-radius: 30px;
                border-color: #2ecc71;
                width: 80%;
                bottom: 100px;
                background: rgba(25, 25, 25, 0.5);
            }


            #search_button {
                background: none;
                border: 2px solid #2ecc71;
                padding: 10px 35px;
                color: white;
                border-radius: 20px;
                outline: none;
                transition: 0.25s;
                position: absolute;
                bottom: 50px;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #search_button:hover {
                background: #2ecc71;
            }

            .message {
                border-radius: 15px;
                padding: 10px 20px;
                margin: 5px 0px;
                display: inline-block;
                font-weight: bold;
                max-width: 500px;
                overflow-wrap: break-word;
                font-size: 20px;
            }

            .margin {
                width: 100%;
                display: inline-block;
            }


            #right {
                text-align: right;
                float: right;
                color: white;
                background-color: #00adb5;
                margin-right: 30px;
            }

            #left {
                text-align: left;
                float: left;
                color: #393e46;
                background-color: #eeeeee;
                margin-left: 30px;
            }

            #back {
                position: absolute;
                top: 50%;
                left: 40px;
                height: 30px;
                width: 30px;
                border-radius: 10px;
                text-align: left;
                background: none;
                padding: 10px;
                background-repeat: no-repeat;
                border: none;
                background-size: 80% 80%;
                transform: translate(-50%, -50%);
                background-position: center;
                transition: 0.25s;
            }

            #back:hover {
            	background: rgba(0, 0, 0, 0.1);
            	cursor: pointer;
            }

            ::-webkit-scrollbar {
                width: 10px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1); 
            }
 
            ::-webkit-scrollbar-thumb {
                background: #888; 
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }

            #scripts {
            	display: none;
            }

            #logout {
                position: absolute;
                top: 40px;
                left: 40px;
                height: 40px;
                width: 40px;
                background: none;
                background-repeat: no-repeat;
                border: none;
                background-size: 80% 80%;
                transform: translate(-50%, -50%);
                background-position: center;
                transition: 0.25s;
                opacity: 0.2;
                cursor: pointer;
            }

            #logout:hover {
            	opacity: 0.7;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript">
            function check_names(email, user) {
                var dataString="email=" + email + "&user=" + user;
                $.ajax({
                    type:"post",
                    url:"search.php",
                    data:dataString,
                    cache:false,
                    success: function(html) {
                        $('#scripts').html(html);
                    }
                });
                return false;
            }
        </script>


        <script type="text/javascript">
            function prepare() {
                var message = document.getElementById('textbox').value;
                var dataString='message='+ message;
                $.ajax({
                    type:"post",
                    url:"write.php",
                    data:dataString,
                    cache:false,
                    success: function(html) {
                        $('#scripts').html(html);
                    }
                });
                return false;
            }
        </script>


        <script type="text/javascript">
            function refresh() {
                $.ajax({
                    type:"post",
                    url:"refresh.php",
                    cache:false,
                    success: function(html) {
                        $('#scripts').html(html);
                    }
                });
                return false;
            }
        </script>

        <script type="text/javascript">
            function logout() {
                $.ajax({
                    type:"post",
                    url:"logout.php",
                    cache:false,
                    success: function(html) {
                        $('#scripts').html(html);
                    }
                });
                return false;
            }
        </script>

        <title>Tile</title>
        <link rel="icon" href="\Assets\Icon\favicon.ico" type="image/x-icon">
    </head>
    <body>
    	<img src="logout.png" id="logout" onclick="logout()">
        <div id="main_page">
            <h2 id="greeting">
                Users
            </h2>
            <div id="users">
                <?php
                    for ($i=2; $i<$n; ++$i) {
                        echo '<div id="user" onclick="return check_names(\''.$information[$i][1].'\',\''.$information[$i][2].'\')"><div id="user_name">'.$information[$i][2].'</div><div id="user_email">'.$information[$i][1].'</div></div>';
                    }
                ?>
            </div>
            <div id="header">
            	<img src="back.png" id="back" onclick="transform_back()">
                <div id="header_user">
                </div>
                <div id="header_email">
                </div>
            </div>
            <div id="messages">
            </div>
            <div id="textpad">
                <form>
                    <input type="text" placeholder="Write here" id="textbox" requred>
                    <input type="submit" id="sendable" value="" onclick="return prepare()">
                </form>
            </div>
        </div>
        <p id="scripts"></p>
    </body>
    <script type="text/javascript">
        function transform_main() {
            document.getElementById("main_page").style.height = "70%";
            document.getElementById("main_page").style.width = "70%";
            document.getElementById("greeting").style.display = "none";
            document.getElementById("users").style.display = "none";
            document.getElementById("header").style.display = "block";
            document.getElementById("textpad").style.display = "block";
            document.getElementById("messages").style.display = "block";
        }

        function transform_back() {
            document.getElementById("main_page").style.height = "45%";
            document.getElementById("main_page").style.width = "30%";
            document.getElementById("greeting").style.display = "block";
            document.getElementById("users").style.display = "block";
            document.getElementById("header").style.display = "none";
            document.getElementById("textpad").style.display = "none";
            document.getElementById("messages").style.display = "none";
            document.getElementById("messages").innerHTML = "";
        }

        setInterval(refresh, 1000);
    </script>
</html>