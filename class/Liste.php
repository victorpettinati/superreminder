<?php

class Liste {

    private $id;

    private $id_user;

    private $list_name;

    private $list_content;


    public function __construct(
        int $id = null,
        int $id_user = null,
        string $list_name = "",
        string $list_content = ""
    )
    {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->list_name = $list_name;
        $this->list_content = $list_content;
        
    }

    public function getIt(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getId_user(){
        return $this->id_user;
    }
    public function setId_user($id_user){
        $this->id_user = $id_user;
    }
    public function getList_name(){
        return $this->list_name;
    }
    public function setList_name($list_name){
        $this->list_name = $list_name;
    }
    public function getList_content(){
        return $this->list_content;
    }
    public function setList_content($list_content){
        $this->list_content = $list_content;
    }

    public function addExperience($id_cv, $exp_title, $date_start, $date_end, $exp_explanation){
       
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "cv-crafter";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        $sql = "INSERT INTO experience (id_cv, exp_title, date_start, date_end, exp_explanation)
        VALUES (:id_cv, :exp_title, :date_start, :date_end, :exp_explanation)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_cv', $id_cv, PDO::PARAM_STR);
            $stmt->bindParam(':exp_title', $exp_title, PDO::PARAM_STR);
            $stmt->bindParam(':date_start', $date_start, PDO::PARAM_STR);
            $stmt->bindParam(':date_end', $date_end, PDO::PARAM_STR);
            $stmt->bindParam(':exp_explanation', $exp_explanation, PDO::PARAM_STR);

            $stmt->execute();
            echo "Expérience ajoutée avec succès.";
            return true; // Retourne true pour indiquer le succès de l'opération.
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur lors de l'insertion, retourne false.
        }

    }

    public function delNote(){

    }
    public function updateNote(){

    }

    public function readNote(){
        
    }

    public function getCvDetails($id_cv) {
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "cv-crafter";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    
        // Récupérez les expériences pour ce CV
        $sql = "SELECT * FROM experience WHERE id_cv = :id_cv";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_cv', $id_cv, PDO::PARAM_STR);
        $stmt->execute();
        $experiences = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Récupérez les formations pour ce CV
        $sql = "SELECT * FROM formation WHERE id_cv = :id_cv";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_cv', $id_cv, PDO::PARAM_STR);
        $stmt->execute();
        $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Récupérez les loisirs pour ce CV
        $sql = "SELECT * FROM loisir WHERE id_cv = :id_cv";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_cv', $id_cv, PDO::PARAM_STR);
        $stmt->execute();
        $loisirs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Vous pouvez maintenant retourner ces données pour les utiliser dans votre vue
        return [
            'experiences' => $experiences,
            'formations' => $formations,
            'loisirs' => $loisirs,
        ];
    }
}