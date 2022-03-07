<?php
require_once 'inc/functions.php';
require_once 'inc/database.php';

class Post
{

    public $id_post;
    public $titre;
    public $description;
    public $image;
    public $date_creation;
    public $date_modification;
    public $id_user;

}


function deletePost($id)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  DELETE POST  ***/
    $conn->prepare('delete from posts where id_post= ? ')->execute([$id]);

}

function getPosts()
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    $query = $conn->prepare('select  * from posts order by date_creation desc ;');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_CLASS, 'post');
}

function getLatestsPosts()
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    $query = $conn->prepare('select  * from posts order by date_creation desc limit 4;');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_CLASS, 'post');

}

function getPost($id)
{

    $db = new DbConnection();
    $conn = $db->getConnection();
    /***  get POST   ***/
    $query = $conn->prepare('select * from posts where id_post= ?');
    $query->execute([$id]);
    return $query->fetchObject('post');
}

function addpost($titre, $description, $image)
{
    $titre = htmlspecialchars($titre);
    $description = htmlspecialchars($description);

    $tmpName = $image['tmp_name'];
    $name = $image['name'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));

    $uniqueName = uniqid('', true);
    //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
    $file = $uniqueName . "." . $extension;
    move_uploaded_file($tmpName, './assets/img/' . $file);


    $pseudolength = strlen($titre);

    if ($pseudolength <= 255) {
        $user = unserialize(serialize($_SESSION['user']));
        $db = new DbConnection();
        $conn = $db->getConnection();
        $insertmbr = $conn->prepare('INSERT INTO  posts (titre,description,image,id_user,date_creation) VALUES(?,?,?,?,now()) ');
        $insertmbr->execute(array($titre, $description, $file, $user->id));

        $erreur = 'votre post a eté ajouter';
    } else {
        $erreur = 'erreur';
    }


}

function updatePost($id, $titre, $description, $image)
{
    $titre = htmlspecialchars($titre);
    $description = htmlspecialchars($description);
    $db = new DbConnection();
    $conn = $db->getConnection();
    if (isset($image) && !empty($image['name'])) {
        $tmpName = $image['tmp_name'];
        $name = $image['name'];

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));

        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $file = $uniqueName . "." . $extension;
        move_uploaded_file($tmpName, './assets/img/' . $file);
        $query = $conn->prepare('update posts set titre=?, description=?,image=?, date_modification = now() where id_post = ? ');
        $query->execute(array($titre, $description, $file, $id));
    } else {
        $query = $conn->prepare('update posts set titre=?, description=?, date_modification = now() where id_post = ? ');
        $query->execute(array($titre, $description, $id));
    }

}