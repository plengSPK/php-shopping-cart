<?php

class Item {

    public function fetch_all(){
        global $conn;

        $query = $conn->prepare("SELECT * FROM tblproduct");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetch_data($id){
        global $conn;

        $query = $conn->prepare("SELECT * FROM tblproduct WHERE id = ?");
        $query->bindValue(1, $id);
        $query->execute();

        return $query->fetch();
    }
}