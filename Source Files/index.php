<?php
  session_start();
  if (isset($_SESSION["email"])) {
    header("Location: http://david.bartok.ro/home");
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

            #title {
                font-family: bebas_neueregular;
                letter-spacing: 50px;
                font-size: 100px;
                color: #36393f;
                position: absolute;
                left: 50%;
                top: 15%;
                transform: translate(-30%, -50%);
            }

            img {
                height: 80px;
                position: absolute;
                transform: translate(-50%, -50%);
                top: 50%;
                left: -30%;
                transition: 0.20s;
            }

            img:hover {
                height: 100px;
            }

            h2 {
                line-height: 1.6;
                font-size: 35px;
                color: white;
                font-weight: 500;
            }

            .access{
                background: rgba(25, 25, 25, 0.7);
                border-radius: 10px;
                padding: 10px 60px 30px 60px;
                text-align: center;
                position: absolute;
                font-weight: bold;
                transition: 0.25s;
            }

            #login {
                transform: translate(-50%, -50%);
                width: 15%;
                left: 50%;
                top: 50%;
            }

            #register {
                transform: translate(-50%, -50%);
                width: 30%;
                opacity: 0.1;
                left: 80%;
                top: 50%;
            }

            input[type="text"],
            input[type="password"],
            input[type="email"] {
                background: rgba(25, 25, 25, 0.2);
                display: block;
                color: white;
                border: 2px solid #3498db;
                outline: none;
                width: 70%;
                margin: 20px auto;
                border-radius: 20px;
                text-align: center;
                padding: 18px 10px;
                transition: 0.25s;
            }

            input[type="text"]:focus,
            input[type="password"]:focus,
            input[type="email"]:focus {
                border-radius: 30px;
                border-color: #2ecc71;
                width: 80%;
                background: rgba(25, 25, 25, 0.5);
            }

            input[type="submit"] {
                background: none;
                display: 20px auto;
                border: 2px solid #2ecc71;
                padding: 10px 35px;
                color: white;
                border-radius: 20px;
                outline: none;
                transition: 0.25s;
            }

            input[type="submit"]:hover {
                background: #2ecc71;
            }

            #login_title {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                transform: translate(-50%, 0%);
                left: 50%;
                width: 50%;
            }

            #failed_title_login {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                width: 50%;
                right: 10%;
                opacity: 0;
            }

            #successful_title_login {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                width: 50%;
                right: 10%;
                opacity: 0;
            }

            #register_title {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                transform: translate(-50%, 0%);
                left: 50%;
                width: 50%;
            }

            #failed_title_register {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                width: 50%;
                right: 10%;
                opacity: 0;
            }

            #successful_title_register {
                transition: 0.25s;
                position: absolute;
                text-align: center;
                width: 50%;
                right: 10%;
                opacity: 0;
            }

            #scripts {
                display: none;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            function check_login() {
                var email=document.getElementById('login_email').value;
                var passw=document.getElementById('login_passw').value;
                var dataString='email='+ email + '&passw=' + passw;
                $.ajax({
                    type:"post",
                    url:"login.php",
                    data:dataString,
                    cache:false,
                    success: function(html) {
                        $('#scripts').html(html);
                    }
                });
                return false;
            }

            function check_register() {
                var email = document.getElementById("register_email").value;
                var passw = document.getElementById("register_passw").value;
                var user = document.getElementById("register_user").value;
                var dataString = "email=" + email + "&passw=" + passw + "&user=" + user;
                $.ajax({
                    type:"post",
                    url:"register.php",
                    data:dataString,
                    cache:false,
                    success: function(html) {
                    $("#scripts").html(html);
                    }
                });
                return false;
            }

            function sleep(milliseconds) {
                var start = new Date().getTime();
                for (var i = 0; i < 1e7; i++) {
                    if ((new Date().getTime() - start) > milliseconds){
                        break;
                    }
                }
            }
        </script>
        <title>Tile</title>
        <link rel="icon" href="Assets\Icon\favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div id="title">
            <img src="Assets\Logo\Untitled-2.png"> 
            ti<span onclick="Dim()">l</span>e
        </div>
        <a href="#">
            <div class="access" id="login" onclick="HideRegister()">
                <script type="text/javascript">
                    function login_failed() {
                        document.getElementById("login_title").style.marginLeft = "25%";
                        document.getElementById("login_title").style.left = "10%";
                        document.getElementById("failed_title_login").style.opacity = "1";
                    }

                    function login_success() {
                    	setTimeout(() => {window.location.replace('home'); }, 1000);
                        document.getElementById("login_title").style.marginLeft = "25%";
                        document.getElementById("login_title").style.left = "10%";
                        document.getElementById("failed_title_login").style.opacity = "0";
                        document.getElementById("successful_title_login").style.opacity = "1";
                    }
                </script>
                <div style="height: 90px;">
                    <div id="login_title">
                        <h2>Login</h2>
                    </div>
                    <div id="failed_title_login">
                        <h2>Failed</h2>
                    </div>
                    <div id="successful_title_login">
                        <h2>Success</h2>
                    </div>
                </div>
                <form id="login_form" action="home\">
                    <input type="email" id="login_email" name="email" placeholder="Email" required>
                    <input type="password" id="login_passw" name="pass" placeholder="Password" required>
                    <input type="submit" name="submit" value="Submit" onclick="return check_login()">
                </form>
            </div>
        </a>
        <a href="#">
            <div class="access" id="register" onclick="HideLogin()">
                <script type="text/javascript">
                    function register_failed() {
                        document.getElementById("register_title").style.marginLeft = "25%";
                        document.getElementById("register_title").style.left = "10%";
                        document.getElementById("failed_title_register").style.opacity = "1";
                    }
                    function register_success() {
                        document.getElementById("register_title").style.marginLeft = "25%";
                        document.getElementById("register_title").style.left = "10%";
                        document.getElementById("failed_title_register").style.opacity = "0";
                        document.getElementById("successful_title_register").style.opacity = "1";
                    }
                </script>
                <div style="height: 90px;">
                    <div id="register_title">
                        <h2>Register</h2>
                    </div>
                    <div id="failed_title_register">
                        <h2>Failed</h2>
                    </div>
                    <div id="successful_title_register">
                        <h2>Success</h2>
                    </div>
                </div>
                <form id="register_form">
                    <input type="email" id="register_email" name="email" placeholder="Email" required>
                    <input type="text" id="register_user" name="user" placeholder="Username" required>
                    <input type="password" id="register_passw" name="pass" placeholder="Password" required>
                    <input type="submit" name="submit" value="Submit" onclick="return check_register()">
                </form>
            </div>
        </a>
        <script type="text/javascript">
            var log = document.getElementById("login");
            var reg = document.getElementById("register");
    
            function HideLogin() {
                log.style.opacity = "0.1";
                reg.style.opacity = "1";
                reg.style.width = "32%";
                reg.style.left = "50%";
                log.style.left = "75%";
            }

            function HideRegister() {
                reg.style.opacity = "0";
                log.style.opacity = "1";
                reg.style.width = "30%";
                reg.style.left = "80%";
                log.style.left = "50%";
                reg.style.opacity = "0.1";
            }

            function Dim() {
                document.body.style.opacity = "0.05";
                document.body.style.background = "#000000";
            }
        </script>
        <p id="scripts"></p>
    </body>
</html>