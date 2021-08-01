<?php
if(!isset($_SESSION))
{
session_start();
}

echo <<<_INIT
<!DOCTYPE html> 
<html>
    <head>
        <meta charset='utf-8'>
        <meta name=viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
        <link rel='stylesheet' href='style1.css'>
        <script src='javascript.js'></script>
        <script src='jquery-2.2.4.min.js'></script>
        <script src='jquery.mobile-1.4.5.min.js'></script>

_INIT;

    require_once 'function.php';

    $userstr = 'Welcome Guest';
    if(isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        $userstr = "Logged in as: $user";
    }
    else $loggedin = FALSE;

echo <<<_MAIN
    <title>Friend's Meet: $userstr</title>
    </head>

<body>
    <div data-role='page'>
        <div data-role='header'>
        <div id="logo" class="center" style="display: flex;">
            <img id="friend" src="friend_2.png" style="width: 200px;">
            <h1 style="width: 100%;font-size: 40px;text-align: center;">Friends Meet</h1>
        </div>
        <div class='username'>$userstr</div>
        </div>
        <div data-role='content'>
    </div>
    <script>
    var btnContainer = document.getElementById("myDIV");

var btns = btnContainer.getElementsByClassName("nav-item");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
    </script>
_MAIN;

if($loggedin)
{
echo <<<_LOGGEDIN
    <div class='myDIV'>
    <ul class='navbar'>
    <li class='nav-item'><a href='members.php?view="$user'">Home</a></li>
    <li class='nav-item'><a href='members.php'>Members</a></li>
    <li class='nav-item'><a href='friends.php'>Friends</a></li>
    <li class='nav-item'><a href='messages.php'>Messages</a></li>
    <li class='nav-item'><a href='profile.php'>Edit Profile</a></li>
    <li class='nav-item'><a href='logout.php'>Log out</a></li>

    </ul>
    </div>
    
_LOGGEDIN;
}
else
{
echo <<<_GUEST
    <div class='center'>
        <a data-role='button' data-inline='true' data-icon='home'
            data-transition='slide' href='index.php'>Home</a>
        <a data-role='button' data-inline='true' data-icon='plus'
            data-transition='slide' href='signup.php'>Sign up</a>
        <a data-role='button' data-inline='true' data-icon='check'
            data-transition='slide' href='login.php'>Log In</a>
    </div>
    <p class='info'>(You must be logged in to use this app)</p>

_GUEST;
 }   

?>