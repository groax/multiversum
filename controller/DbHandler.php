<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 25-5-2017
 * Time: 01:12
 */

class DbHandler {
    var $host;
    var $db;
    var $user;
    var $pass;

    function __construct($host, $db, $user, $pass) {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;

        try {
            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->db", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function Read($sql) {
    try {
        $get = $this->conn->prepare($sql);
        $get->execute();
        // $result = $get->fetchAll();
        // return $result;
        return $result = $get->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

    public function Create($sql) {
    try {
        $this->conn->exec($sql);
        return $this->sql = 'Added Item<br><br>';

    } catch (PDOException $e) {
        return 'Create failed: ' . $e->getMessage();
    }
}

    public function Update($sql) {
    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $result = $stmt->rowCount();

    } catch (PDOException $e) {
        return 'Update failed: ' . $e->getMessage();
    }
}

    public function Delete($sql) {
    try {
        $get = $this->conn->exec($sql);

        if($get) {
            return 'Item deleted';
        } else {
            return false;
        }

    } catch (PDOException $e) {
        return 'Delete failed: ' . $e->getMessage();
    }
}
}