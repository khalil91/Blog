<?php
require_once 'models/CommentService.php';

class CommentController
{

    private $service;

    public function __construct()
    {
        $this->service = new CommentService();
    }

    function deleteCommentAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        $this->service->deleteComment($_GET['id']);
        header("Location: dashboard");

    }

    function validateCommentAction()
    {
        if (!isset($_SESSION['user'])) {
            require('views/sign-in.php');
            return;
        }

        $this->service->validateComment($_GET['id']);
        header("Location: dashboard");

    }
}

