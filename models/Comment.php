<?php
require_once 'inc/functions.php';
require_once 'inc/database.php';

class Comment
{

    public $id_comment;
    public $comment;
    public $date_creation;
    public $validated;
    public $id_user;
    public $id_post;

}


function getCommentsAdmin()
{
    $db = new DbConnection();
    $conn = $db->getConnection();

    /**  afficher les commentaires **/
    $query = $conn->prepare('select * from comments, posts, utilisateur where comments.id_user=id and comments.id_post=posts.id_post order by comments.date_creation desc;');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_CLASS, 'comment');
}

function addComments($id, $comment)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  PUT COMMENT  ***/
    $user = unserialize(serialize($_SESSION['user']));
    if (isset($comment)) {
        $conn->prepare(' INSERT INTO comments (comment,id_user,id_post,date_creation) VALUES(?,?,?, now())')
            ->execute([$comment, $user->id, $id]);
    }
}

function deleteComment($id)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  DELETE COMMENT  ***/
    $conn->prepare('delete from comments where id_comment= ? ')->execute([$id]);

}

function validateComment($id)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  DELETE COMMENT  ***/
    $conn->prepare('update comments set validated=true where id_comment= ? ')->execute([$id]);

}