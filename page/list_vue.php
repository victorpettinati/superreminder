
<?php
session_start();
include '../class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php


$user = new User(); // Créez une instance de la classe User


if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    $session_id = $_SESSION["id"];
    // Utilisez la méthode getUserInfo pour obtenir les données de l'utilisateur
    $userData = $user->getUserInfos($email);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list_vue</title>
    <link rel="stylesheet" type="text/css" href="../style/style_profil.css">

</head>
<body>
    <form method="post" action="../module/module_createList.php">
        <label for="list_name">Create list</label>
        <input type="text" id="list_name" name="list_name">
        <input type="submit" value="enter">
    </form>

    <div id="form">
        <form name="list_selector" id="list_selector" method="get" action="../module/module_selectList.php">
        <label for="select_list">Sélectionnez un CV : </label>
        <select id="select_list" name="select_list">
        <?php

        $listOfList = $user->getList_list($session_id);

        foreach ($listOfList as $list) {
            echo '<option value="' . $list['id'] . '">' . $list['list_name'] . '</option>';
        }
        ?>
        </select>
        <input type="submit" name="load_list" value="Charger la list sélectionné">
        </form>

        <?php echo "list charger : " . $_SESSION["id_list"] ?>
    </div>
    <?php var_dump($listOfList); ?>
    <form method="post" action="../module/module_addNote.php">
        <input type="date" id="date_end" name="date_end">
        <label for="note_content">ajouter une note </label>
        <input type="text" id="note_content" name="note_content">
        <input type="submit" value="enter">

    </form>
</body>

<?php
};
 ?>