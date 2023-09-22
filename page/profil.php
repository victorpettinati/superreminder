<?php
session_start();
include '../class/User.php';

$user = new User();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];


    // Utilisez la méthode getUserInfo pour obtenir les données de l'utilisateur
    $userData = $user->getUserInfos($email);

    // Vérifier si $userData n'est pas null

?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CV-crafter</title>
            <link rel="stylesheet" type="" href="">
        </head>
        <body>
            Bienvenue <?php echo htmlspecialchars($userData["nom"]) . " " . htmlspecialchars($userData["prenom"]); ?>
            <div>
                <form id="form_modif_profil" method="post" action="../module/module_profilModif.php">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" placeholder="entrez votre nom : " value="<?php echo htmlspecialchars($userData["nom"]); ?>">
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" placeholder="entrez votre prenom : " value="<?php echo htmlspecialchars($userData["prenom"]); ?>">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" placeholder="enter your email : " value="<?php echo htmlspecialchars($userData["email"]); ?>">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <label for="confirme_password">Confirme password</label>
                    <input type="password" name="confirme_password" id="confirme_password">
                    <input type="submit" value="Enter">
                </form>
            </div>
            <a href="../todolist.php">To Do List</a>
            <a href="deconnexion.php">deconnexion</a>
        </body>
        </html>
        <?php
    }

?>
