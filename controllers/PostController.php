<?php
require_once 'models/Comment.php';
require_once 'models/Post.php';
require_once 'models/comment_utilisateur.php';

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

    if (isset($_POST['comment'])) {
        addComments($_GET['id'], $_POST['comment']);
    }
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

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