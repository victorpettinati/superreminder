<?php
session_start();
include '../class/Liste.php';

// Vérifier si le formulaire a été soumis
if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_SESSION['username']) && isset($_SESSION["id"]) && isset($_SESSION["id_list"])) {
    // Créez une instance de la classe User
    $cv = new Liste();

    $id_list = $_SESSION["id_list"];
    $date_end = $_POST["date_end"];
    $note_content = $_POST["note_content"];
    var_dump($id_list);



    // Appelez la méthode inscripUser pour enregistrer l'utilisateur
    $cv->addNote($id_list, $date_end, $note_content);
    header("Location: ../page/list_vue.php");
    exit;
}


?>
