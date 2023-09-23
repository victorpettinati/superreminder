<?php
session_start();
// Inclure la classe User
include '../class/User.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créez une instance de la classe User
    $user = new User();

    // Récupérez les données du formulaire
    $list_name = $_POST["list_name"];
    $id_user = $_SESSION["id"];



    // Appelez la méthode inscripUser pour enregistrer l'utilisateur
    $user->createList($id_user, $list_name);
    header("Location: ../page/list_vue.php");
    exit;
}


?>
