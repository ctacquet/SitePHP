<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function template_header() {
    $maintenance = false;
    echo '
    <!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/functions.css"/>
        <link rel="stylesheet" type="text/css" href="css/svgtimer.css">
        
        <!-- Scripts Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="js/svgtimer.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Source+Sans+Pro&display=swap" rel="stylesheet">

        <!-- Icon -->
        <link rel="icon" href="img/icone.ico" />
        <title>ShareYourMusic</title>
    </head>
    <div class="header">
    <a class="title" href="/">
        <span class="symbol"><img src="img/logo.svg"></span>ShareYourMusic
    </a>';
    if (!isset($_SESSION['loggedin'])) {
        echo '<!-- Modal Box de login-->
        <div class="navbarButtons" id="NotLogged">
            <a class="navtop" id="modalButton"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a class="navtop" id="modalButton2"><i class="fas fa-user-plus"></i> Register</a>
        </div>
        <div id="loginModal" class="modal">
            <div class="modal-content">
                <table width=100% style="color: black;">
                <tr>
                    <td width=27% style="text-align: center;">
                        <table width=100%>
                            <form action="php/authenticate.php" method="post">
                            <tr>
                                <td>
                                    <label for="username">
                                        <i class="fas fa-user"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="username" placeholder="Username" id="username" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">
                                        <i class="fas fa-key"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="password" name="password" placeholder="Password" id="password" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <label for="submitLogin">
                                        <i class="fas fa-check"></i>
                                    </label>
                                    <input type="submit" name="submitLogin" id="submitLogin" value="Log In"><br>
                                </td>
                            </tr>
                            </form>
                        </table>
                    </td>
                    <td width=70% style="text-align: center; vertical-align: top; border-left: 1px solid #e0e0e3; padding-left: 30px;">';
                        if (isset($_SESSION['incorrectusername'])){
                            echo '<p style="color: red">Incorrect Username</p>';
                            unset($_SESSION['incorrectusername']);
                        }
                        if (isset($_SESSION['incorrectpassword'])){
                            echo '<p style="color: red">Incorrect Password</p>';
                            unset($_SESSION['incorrectpassword']);
                        }
                    echo '
                    </td>
                    <td width=3% style="vertical-align: top;">
                        <span class="close">&times;</span>
                    </td>
                </tr>
                </table>
            </div>
        </div>
        <div id="registerModal" class="modal" id="Logged">
            <div class="modal-content">
                <table width=100% style="color: black;">
                <tr>
                    <td width=27% style="text-align: center;">
                        <table class="navbarForm" width=100%>
                            <form action="php/register.php" method="post">
                            <tr>
                                <td>
                                    <label for="usernameReg">
                                        <i class="fas fa-user"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="usernameReg" placeholder="Username" id="usernameReg" autocomplete="off" onclick="document.getElementById(\'usernameSpec\').style.display = \'block\'" onblur="document.getElementById(\'usernameSpec\').style.display = \'none\'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="passwordReg">
                                        <i class="fas fa-key"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="password" name="passwordReg" placeholder="Password" id="passwordReg" autocomplete="off" onclick="document.getElementById(\'passwordSpec\').style.display = \'block\'" onblur="document.getElementById(\'passwordSpec\').style.display = \'none\'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="confirmpasswordReg">
                                        <i class="fas fa-lock"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="password" name="confirmpasswordReg" placeholder="Confirm Password" id="confirmpasswordReg" autocomplete="off" onclick="document.getElementById(\'passwordSpec\').style.display = \'block\'" onblur="document.getElementById(\'passwordSpec\').style.display = \'none\'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="emailReg">
                                        <i class="fas fa-envelope"></i>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="emailReg" placeholder="Email" id="emailReg" onclick="document.getElementById(\'emailSpec\').style.display = \'block\'" onblur="document.getElementById(\'emailSpec\').style.display = \'none\'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <label for="submitReg">
                                        <i class="fas fa-paper-plane"></i>
                                    </label>
                                    <input type="submit" name="submitReg" id="submitReg" value="Register"><br>
                                </td>
                            </tr>
                            </form>
                        </table>
                    </td>
                    <td width=70% style="text-align: center; vertical-align: top; border-left: 1px solid #e0e0e3; padding-left: 30px;">
                        <!-- Username specifications -->
                        <div id="usernameSpec" style="display:none;">
                            <h4 class="infoType">Username</h4>
                            <div class="condition">
                                <i class="far fa-circle" id="condition1"></i>Must be unique<br>
                                <i class="far fa-circle" id="condition2"></i>Must contain at least 3 letters
                            </div>
                        </div>
                        <!-- Password specifications -->
                        <div id="passwordSpec" style="display:none;">
                            <h4 class="infoType">Password</h4>
                            <div class="condition">
                                <i class="far fa-circle" id="condition1"></i>Must contain letters<br>
                                <i class="far fa-circle" id="condition2"></i>Must contain numbers<br>
                                <i class="far fa-circle" id="condition3"></i>Must be between 5 and 20 characters long<br>
                                <i class="far fa-circle" id="condition4"></i>Validate your password
                            </div>
                        </div>
                        <!-- Email specifications -->
                        <div id="emailSpec" style="display:none;">
                            <h4 class="infoType">Email</h4>
                            <div class="condition">
                                <i class="far fa-circle" id="condition1"></i>Write your email<br>
                                <i class="far fa-circle" id="condition2"></i>Must contain @
                            </div>
                        </div>
                        <!-- RedFive specifications -->
                        <div style="display:none;">
                            <h4 class="infoType">To Do</h4>
                            <div class="condition">
                                <i class="far fa-circle" id="condition1"></i>Check if informations that are written respect rules<br>
                                <i class="far fa-circle" id="condition2"></i>Change color of the circle
                            </div>
                        </div>
                    </td>
                    <td width=3% style="vertical-align: top;">
                        <span class="close">&times;</span>
                    </td>
                </tr>
                </table>
            </div>
        </div>';
    } else {
        echo '
        <div class="navbarButtons">
            <a class="navtop" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a>
            <a class="navtop" href="php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>';
    }
    require 'php/bdd.php';
    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('s', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($password, $email);
    $stmt->fetch();
    $stmt->close();
    echo'
    </div>';
    if($maintenance) echo'
    <div class="alert alert-warning alert-dismissible fade show alert-main" role="alert">
        <strong> Maintenance</strong>&nbsp;&nbsp;<span class="fas fa-cog fa-spin"></span>&nbsp;&nbsp;&nbsp;The website is actually in work state
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
}

function template_footer(){
    echo'
            <div class="footer">
                <p>Website created by <a target="_blank" href="https://www.instagram.com/ctacquet/">@Charles Tacquet</a> <i class="fas fa-trademark" style="font-size: 10px; vertical-align: top;"></i></p>
            </div>
        </body>
    </html>';
}
?>
