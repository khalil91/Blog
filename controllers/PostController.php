<?php
require_once 'models/Comment.php';
require_once 'models/Post.php';
require_once 'models/CommentUtilisateur.php';


class PostController
{

    function listPosts()
    {
        if (!isset($_SESSION['user']))
            header("Location: sign-in");

        $posts = getPosts();
        require('views/posts.php');
    }

    function post()
    {

        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }
        $id = htmlspecialchars($_GET['id']);
        if (isset($_POST['comment'])) {
            addComments($id, htmlspecialchars($_POST['comment']));
        }
        $post = getPost($id);
        $comments = getComments($id);

        require('views/post.php');
    }

    function deletePostAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        deletePost($_GET['id']);
        header("Location: dashboard");

    }

}
