<?php


class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;


    
    public function __construct(
        int $id = null,
        string $nom = "",
        string $prenom = "",
        string $email = "",

    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;

    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function inscripUser($nom, $prenom, $email, $password){

        $servername = "localhost";
        $username = "root";
        $password = "Laplateforme.06!";
        $dbname = "superreminder";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }


        if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirme_password"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);
            $confirme_password = $_POST["confirme_password"];
            
            if ($_POST["password"] === $_POST["confirme_password"]){
                
                $sql = "INSERT INTO user (nom, prenom, email, password)
                VALUES (:nom, :prenom, :email, :password)";
                
                try {
                    $sth = $conn->prepare($sql);
                    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $sth->bindParam(':email', $email, PDO::PARAM_STR);
                    $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
                
                    $sth->execute();
                    echo "Données insérées avec succès.";
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }

    }

    public function connecUser($email, $password){

        
        $servername = "localhost";
        $username = "root";
        $password = "Laplateforme.06!";
        $dbname = "superreminder";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        if (isset($_POST["email"]) && $_POST["password"]){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);

            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($hash_password === $user["password"]){
                    $_SESSION['username'] = $user['email'];
                    $_SESSION["id"] = $user["id"];
                    header("location: profil.php");
                    echo "connected";
                    var_dump($_SESSION);
                }
                else{
                    echo "incorect password";
                }
            }
            else{
                echo "User not found";
            }
        }
    }

    public function profileModif($nom, $prenom, $email, $password){
        
        $servername = "localhost";
        $username = "root";
        $password = "Laplateforme.06!";
        $dbname = "superreminder";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        if (isset($_SESSION['username']) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirme_password"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirme_password = $_POST["confirme_password"];

            if ($_POST["password"] === $_POST["confirme_password"]){

                $hash_password = sha1($_POST["password"]);

                $sql = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, password = :password WHERE email = :user_email";

                try {
                    $sth = $conn->prepare($sql);
                    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $sth->bindParam(':email', $email, PDO::PARAM_STR);
                    $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
                    $sth->bindParam(':user_email', $_SESSION['username'], PDO::PARAM_STR);

                    $sth->execute();
                    echo "Données insérées avec succès.";
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
    }

    public function getUserInfos($email){
        if (isset($_SESSION["username"])){
           
            $email = $_SESSION["username"];
            $servername = "localhost";
            $username = "root";
            $password = "Laplateforme.06!";
            $dbname = "superreminder";

            
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        if ($user){
            $this->nom = $user["nom"];
            $this->prenom = $user["prenom"];
            $this->email = $user["email"];
            return $user;

        }
    }
}
