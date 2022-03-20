<?php

require_once 'inc/database.php';
require_once 'dao/PostUser.php';
require_once 'dao/Post.php';

class PostService
{

    private $conn;

    public function __construct()
    {
        $db = new DbConnection();
        $this->conn = $db->getConnection();
    }

    public function deletePost($id)
    {

        /***  DELETE POST  ***/
        $this->conn->prepare('delete from posts where id_post= ? ')->execute([$id]);

    }

    public function getPosts()
    {

        $query = $this->conn->prepare('select  * from posts order by date_creation desc ;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'post');
    }

    public function getLatestsPosts()
    {

        $query = $this->conn->prepare('select  * from posts order by date_creation desc limit 4;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'post');

    }

    public function getPost($id)
    {


        /***  get POST   ***/
        $query = $this->conn->prepare('select * from posts where id_post= ?');
        $query->execute([$id]);
        return $query->fetchObject('post');
    }

    public function addpost($titre, $description, $image)
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

            $insertmbr = $this->conn->prepare('INSERT INTO  posts (titre,description,image,id_user,date_creation) VALUES(?,?,?,?,now()) ');
            $insertmbr->execute(array($titre, $description, $file, $user->id));

            $erreur = 'votre post a eté ajouter';
        } else {
            $erreur = 'erreur';
        }


    }

    public function updatePost($id, $titre, $description, $image)
    {
        $titre = htmlspecialchars($titre);
        $description = htmlspecialchars($description);


        if (isset($image) && !empty($image['name'])) {
            $tmpName = $image['tmp_name'];
            $name = $image['name'];

            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));

            $uniqueName = uniqid('', true);
            //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
            $file = $uniqueName . "." . $extension;
            move_uploaded_file($tmpName, './assets/img/' . $file);
            $query = $this->conn->prepare('update posts set titre=?, description=?,image=?, date_modification = now() where id_post = ? ');
            $query->execute(array($titre, $description, $file, $id));
        } else {
            $query = $this->conn->prepare('update posts set titre=?, description=?, date_modification = now() where id_post = ? ');
            $query->execute(array($titre, $description, $id));
        }

    }

    public function getPostsAdmin()
    {

        $query = $this->conn->prepare('select * from posts, utilisateur where id_user=id order by date_creation desc;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'PostUser');

    }
}