<?php

require_once 'inc/database.php';

class User
{

    public $id;
    public $email;
    public $password;
    public $nom;
    public $prenom;
    public $role;

}

function signIn($username, $password)
{
    $db = new DbConnection();
    $conn = $db->getConnection();
    $mail = htmlspecialchars($username);
    $password = stripslashes($password);
    $query = $conn->prepare("SELECT * FROM utilisateur WHERE email='$mail'");
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
    $db = new DbConnection();
    $conn = $db->getConnection();
    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $mail = htmlspecialchars($email);
    $query = $conn->prepare("SELECT * FROM utilisateur WHERE email='$mail'");
    $query->execute();
    $user = $query->fetchObject('user');
    if ($user !== null)
        return "<p class='text-gray-600'>Il semble que vous avez un compte! merci de de <a href='sign-in' class='font-bold'>Se connecter</a>.</p>";

    $password = htmlspecialchars($password);
    //requete SQL + mot de passe crypté
    $insert = $conn->prepare("INSERT into utilisateur (nom, prenom, email, password) VALUES ('$nom', '$prenom','$mail', '" . password_hash($password, PASSWORD_BCRYPT) . "')");
    // Exécuter la requête sur la base de données
    $insert->execute(array('$nom', '$prenom', '$mail', password_hash($password, PASSWORD_BCRYPT)));
    if ($insert)
        return "Vous êtes inscrit avec succès.";

}