<?php
require_once 'models/User.php';
require_once 'models/post_user.php';


function signInUser()
{
    $message = null;
    if (isset($_POST['username'])) {
        $message = signIn(htmlspecialchars($_POST['username']), $_POST['password']);
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
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
        $message = registerUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);
    }
    require('views/register.php');
}