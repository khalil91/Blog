<?php
require_once 'models/User.php';
require_once 'models/post_user.php';


function signInUser()
{
    $message = null;
    if (isset($_POST['username'])) {
        $message = signIn($_POST['username'], $_POST['password']);
        if ($message == null) {
            if ($_SESSION['user']->role == 'admin')
                header("Location: dashboard");
            else
                home();
            return;
        }
    }
    require('views/sign-in.php');
}

function logout()
{
    session_destroy();
    header("Location: sign-in");
}

function register()
{
    $message = "";
    if (isset($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password'])) {
        $message = registerUser($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['email'], $_REQUEST['password']);
    }
    require('views/register.php');
}