<?php
require_once 'models/CommentService.php';
require_once 'models/PostService.php';


class PostController
{

    private $postService;
    private $commentService;

    public function __construct()
    {
        $this->postService = new PostService();
        $this->commentService = new CommentService();
    }

    public function listPosts()
    {
        if (!isset($_SESSION['user']))
            header("Location: sign-in");

        $posts = $this->postService->getPosts();
        require('views/posts.php');
    }

    public function post()
    {

        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }
        $id = htmlspecialchars($_GET['id']);
        if (isset($_POST['comment'])) {
            $this->commentService->addComments($id, htmlspecialchars($_POST['comment']));
        }
        $post = $this->postService->getPost($id);
        $comments = $this->commentService->getComments($id);

        require('views/post.php');
    }

    public function deletePostAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        $this->postService->deletePost($_GET['id']);
        header("Location: dashboard");

    }

}
