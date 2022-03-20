<?php
require_once 'models/Comment.php';

class CommentController
{
    function deleteCommentAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        deleteComment($_GET['id']);
        header("Location: dashboard");

    }

    function validateCommentAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        validateComment($_GET['id']);
        header("Location: dashboard");

    }
}

