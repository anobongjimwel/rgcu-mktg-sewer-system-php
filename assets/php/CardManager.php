<?php

class CardManager
{
    private $destination, $username, $password, $db;

    public function __construct()
    {
        $this->username = "root";
        $this->password = "";
        $this->destination = "mysql:host=localhost;dbname=rgcu_sewer";

        $this->db = new PDO($this->destination, $this->username, $this->password);
    }

    public function countCards()
    {
        $query = $this->db->query("SELECT * FROM cards");
        if ($query->rowCount() < 1) {
            return 0;
        } else {
            return $query->rowCount();
        }
    }

    public function getCards()
    {
        $query = $this->db->query("SELECT * FROM cards");
        if ($query->rowCount() > 0) {
            $cards = $query->fetchAll(PDO::FETCH_ASSOC);
            return $cards;
        }
    }

    public function searchCard($q)
    {
        $query = $this->db->query("SELECT * FROM cards WHERE item LIKE '%$q%' OR design LIKE '%$q%' OR store LIKE '%$q%'");
        if ($query->rowCount() > 0) {
            $employees = $query->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        }
    }

    public function addCard($item, $design, $store)
    {
        $query = $this->db->prepare("INSERT INTO cards (item, design, store) VALUES ('$item', '$design', '$store')");
        if ($query->execute()) {
            return true;
        } else {
            return $query->errorInfo();
        }
    }

    public function editCard($id, $item, $design, $store)
    {
        $query = $this->db->prepare("UPDATE cards SET item = :item, design = :design, store = :store WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->bindParam(":item", $item);
        $query->bindParam(":design", $design);
        $query->bindParam(":store", $store);
        if ($query->execute()) {
            return true;
        } else {
            return $query->errorInfo();
        }
    }

    public function deleteCard($id)
    {
        $query = $this->db->query("DELETE FROM cards WHERE id = $id");
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function searchCardById($q)
    {
        $query = $this->db->query("SELECT * FROM cards WHERE id = $q");
        if ($query->rowCount() > 0) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}

$cardMgr = new CardManager();