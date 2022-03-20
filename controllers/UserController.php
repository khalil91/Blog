<?php
require_once 'models/UserService.php';

class UserController
{

    private $userService;
    private $homeController;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->homeController = new HomeController();
    }

    function logout()
    {
        session_destroy();
        header("Location: sign-in");
    }

    function signInUser()
    {
        $message = null;
        if (isset($_POST['username'])) {
            $message = $this->userService->signIn(htmlspecialchars($_POST['username']), $_POST['password']);
            if ($message === null) {
                if ($_SESSION['user']->role == 'admin')
                    header("Location: dashboard");
                else
                    $this->homeController->home();
                return;
            }
        }
        require('views/sign-in.php');
    }

    function register()
    {
        $message = "";
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'])) {
            $message = $this->userService->registerUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password']);
        }
        require('views/register.php');
    }
}