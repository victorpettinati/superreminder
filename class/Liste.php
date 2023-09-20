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
}


class note{
    private $id;
    private $id_list;
    private $date_end;
    private $note_content;


    public function __construct(
        int $id = null,
        int $id_list = null,
        string $date_end = "",
        string $note_content = "",
    )
    {
        $this->id = $id;
        $this->id_list = $id_list;
        $this->date_end = $date_end;
        $this->note_content = $note_content;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getId_list(){
        return $this->id_list;
    }
    public function setId_list($id_list){
        $this->id_list = $id_list;
    }
    public function getDate_end(){
        return $this->date_end;
    }
    public function setDate_end($date_end){
    $this->date_end = $date_end;
    }
    public function getNote_content(){
        return $this->note_content;
    }
    public function setNote_content($note_content){
        $this->note_content = $note_content;
    }

    public function addExperience($id_list, $date_end, $note_content){
       
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

        $sql = "INSERT INTO note (id_list, date_end, note_content)
        VALUES (:id_list, :date_end, :note_content)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_list', $id_list, PDO::PARAM_STR);
            $stmt->bindParam(':date_end', $date_end, PDO::PARAM_STR);
            $stmt->bindParam(':note_content', $note_content, PDO::PARAM_STR);

            $stmt->execute();
            echo "Tâche ajoutée avec succès.";
            return true; // Retourne true pour indiquer le succès de l'opération.
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur lors de l'insertion, retourne false.
        }

    }

}