<?php
session_start();
// Inclure la classe User
include '../class/User.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créez une instance de la classe User
    $user = new User();

    // Récupérez les données du formulaire
    $name = $_POST["nom"];
    $surname = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hash_password = sha1($password);
    $confirme_password = $_POST["confirme_password"];
    $hash_password2 = sha1($confirme_password);

    // Appelez la méthode inscripUser pour enregistrer l'utilisateur
    $user->inscripUser($name, $surname, $email, $password, $birthdate);
    header("Location: ../page/connexion.php");
    exit;
}


?>
