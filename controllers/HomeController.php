<?php
require_once 'models/User.php';
require_once 'models/PostUser.php';

class HomeController
{
    function home()
    {
        $posts = getLatestsPosts();
        require('views/home.php');
    }

    function dashboard()
    {
        if (!isset($_SESSION['user']))
            header("Location: sign-in");
        else
            $user = unserialize(serialize($_SESSION['user']));

        if ($user->role != 'admin') {
            header("Location: /");
        }
        if (isset($_POST['update_id']) && !empty($_POST['titre']) && !empty($_POST['description'])) {
            updatePost($_POST['update_id'], $_POST['titre'], $_POST['description'], $_FILES['file']);
        } else if (!empty($_POST['titre']) && !empty($_POST['description']) && isset($_FILES['file'])) {
            addpost($_POST['titre'], $_POST['description'], $_FILES['file']);
        }

        $posts = getPostsAdmin();
        $comments = getCommentsAdmin();


        require('views/dashboard.php');
    }
}

