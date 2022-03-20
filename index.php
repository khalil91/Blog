<?php
session_start();

require_once 'controllers/UserController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/CommentController.php';

$userController = new UserController();
$postController = new PostController();
$homeController = new HomeController();
$commentController = new CommentController();


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        $postController->listPosts();
    } else if ($_GET['action'] == 'sign-in') {
        $userController->signInUser();
    } else if ($_GET['action'] == 'dashboard') {
        $homeController->dashboard();
    } else if ($_GET['action'] == 'register') {
        $userController->register();
    } else if ($_GET['action'] == 'logout') {
        $userController->logout();
    } elseif ($_GET['action'] == 'post') {

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postController->post();
        } else {
            $homeController->home();
        }
    } elseif ($_GET['action'] == 'delete-post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postController->deletePostAction();
        } else {
            $homeController->home();
        }
    } elseif ($_GET['action'] == 'delete-comment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $commentController->deleteCommentAction();
        } else {
            $homeController->home();
        }
    } elseif ($_GET['action'] == 'validate-comment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $commentController->validateCommentAction();
        } else {
            $homeController->home();
        }
    }
} else {
    $homeController->home();
}