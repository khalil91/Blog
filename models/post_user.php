<?php
require_once 'inc/functions.php';
require_once 'inc/database.php';

class post_user
{

    public $id_post;
    public $titre;
    public $description;
    public $image;
    public $date_creation;
    public $date_modification;
    public $id_user;


    public $nom;
    public $prenom;
    public $role;

}


function getPostsAdmin()
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    $query = $conn->prepare('select * from posts, utilisateur where id_user=id order by date_creation desc;');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_CLASS, 'post_user');

}