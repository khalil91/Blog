<?php

require_once 'inc/database.php';
require_once 'dao/User.php';

class UserService
{

    private $conn;

    public function __construct()
    {
        $db = new DbConnection();
        $this->conn = $db->getConnection();
    }

    function signIn($username, $password)
    {
        $mail = htmlspecialchars($username);
        $password = stripslashes($password);
        $query = $this->conn->prepare("SELECT * FROM utilisateur WHERE email='$mail'");
        $query->execute();
        $user = $query->fetchObject('user');

        if ($user !== null)
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = $user;
                return null;
            }

        return "Le nom d'utilisateur est introuvable, merci de s'inscrire.";
    }

    function registerUser($nom, $prenom, $email, $password)
    {

        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        $mail = htmlspecialchars($email);
        $query = $this->conn->prepare("SELECT * FROM utilisateur WHERE email='$mail'");
        $query->execute();
        $user = $query->fetchObject('user');
        if ($user !== null)
            return "<p class='text-gray-600'>Il semble que vous avez un compte! merci de de <a href='sign-in' class='font-bold'>Se connecter</a>.</p>";

        $password = htmlspecialchars($password);
        //requete SQL + mot de passe crypté
        $insert = $this->conn->prepare("INSERT into utilisateur (nom, prenom, email, password) VALUES ('$nom', '$prenom','$mail', '" . password_hash($password, PASSWORD_BCRYPT) . "')");
        // Exécuter la requête sur la base de données
        $insert->execute(array('$nom', '$prenom', '$mail', password_hash($password, PASSWORD_BCRYPT)));
        if ($insert)
            return "Vous êtes inscrit avec succès.";

    }
}