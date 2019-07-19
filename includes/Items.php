<?php

class Item {

    public function fetch_all(){
        global $conn;

        $query = $conn->prepare("SELECT * FROM tblproduct");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetchByCode($code){
        global $conn;

        $query = $conn->prepare("SELECT * FROM tblproduct WHERE code = ?");
        $query->bindValue(1, $code);
        $query->execute();

        return $query->fetch();
    }
}