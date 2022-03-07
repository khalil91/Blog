<?php
session_start();

require 'controllers/UserController.php';
require 'controllers/PostController.php';
require 'controllers/HomeController.php';
require 'controllers/CommentController.php';


if (isset($_GET['action'])) {
    if ($_GET['action'] == 'posts') {
        listPosts();
    } else if ($_GET['action'] == 'sign-in') {
        signInUser();

    } else if ($_GET['action'] == 'dashboard') {
        dashboard();
    } else if ($_GET['action'] == 'register') {
        register();
    } else if ($_GET['action'] == 'logout') {
        logout();
    } elseif ($_GET['action'] == 'post') {

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
            home();
        }
    } elseif ($_GET['action'] == 'delete-post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            deletePostAction();
        } else {
            home();
        }
    } elseif ($_GET['action'] == 'delete-comment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            deleteCommentAction();
        } else {
            home();
        }
    } elseif ($_GET['action'] == 'validate-comment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            validateCommentAction();
        } else {
            home();
        }
    }
} else {
    home();
}