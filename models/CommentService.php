<?php

require_once 'inc/database.php';
require_once 'dao/Comment.php';
require_once 'dao/CommentUtilisateur.php';

class CommentService
{

    private $conn;

    public function __construct()
    {
        $db = new DbConnection();
        $this->conn = $db->getConnection();
    }

    function getCommentsAdmin()
    {

        /**  afficher les commentaires **/
        $query = $this->conn->prepare('select * from comments, posts, utilisateur where comments.id_user=id and comments.id_post=posts.id_post order by comments.date_creation desc;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'comment');
    }

    function addComments($id, $comment)
    {
        /***  PUT COMMENT  ***/
        $user = unserialize(serialize($_SESSION['user']));
        if (isset($comment)) {
            $this->conn->prepare(' INSERT INTO comments (comment,id_user,id_post,date_creation) VALUES(?,?,?, now())')
                ->execute([$comment, $user->id, $id]);
        }
    }

    function deleteComment($id)
    {
        /***  DELETE COMMENT  ***/
        $this->conn->prepare('delete from comments where id_comment= ? ')->execute([$id]);

    }

    function validateComment($id)
    {
        /***  DELETE COMMENT  ***/
        $this->conn->prepare('update comments set validated=true where id_comment= ? ')->execute([$id]);

    }


    function getComments($id)
    {
        /***  GET COMMENTS from POST  ***/
        $query = $this->conn->prepare('select nom, prenom, comment, date_creation from comments join utilisateur u on id_user = u.id where id_post =  ? and validated = true');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'CommentUtilisateur');
    }

}

