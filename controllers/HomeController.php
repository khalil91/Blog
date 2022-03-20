<?php
require_once 'models/UserService.php';

class HomeController
{

    private $postService;
    private $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    function home()
    {
        $posts = $this->postService->getLatestsPosts();
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
            $this->postService->updatePost($_POST['update_id'], $_POST['titre'], $_POST['description'], $_FILES['file']);
        } else if (!empty($_POST['titre']) && !empty($_POST['description']) && isset($_FILES['file'])) {
            $this->postService->addpost($_POST['titre'], $_POST['description'], $_FILES['file']);
        }

        $posts = $this->postService->getPostsAdmin();
        $comments = $this->commentService->getCommentsAdmin();


        require('views/dashboard.php');
    }
}

