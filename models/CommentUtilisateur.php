<?php
require_once 'inc/functions.php';
require_once 'inc/database.php';

class CommentUtilisateur
{

    public $id_comment;
    public $comment;
    public $date_creation;
    public $validated;
    public $id_user;
    public $id_post;


    // utilisateur
    public $nom;
    public $prenom;

}


function getComments($id)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  GET COMMENTS from POST  ***/
    $query = $conn->prepare('select nom, prenom, comment, date_creation from comments join utilisateur u on id_user = u.id where id_post =  ? and validated = true');
    $query->execute([$id]);
    return $query->fetchAll(PDO::FETCH_CLASS, 'CommentUtilisateur');
}