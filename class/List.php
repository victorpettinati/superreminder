<?php

class List {

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