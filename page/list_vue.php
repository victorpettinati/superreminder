
<?php
session_start();
include '../class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php


$user = new User(); // Créez une instance de la classe User


if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    
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
        <label for="list_name">entrer le nom de vote liste</label>
        <input type="text" id="list_name" name="list_name">
        <input type="submit" value="enter">
    </form>

</body>

<?php
};
 ?>