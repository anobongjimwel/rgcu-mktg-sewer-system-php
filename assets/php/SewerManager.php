<?php
    class SewerManager {
        private $destination, $username, $password, $db;

        public function __construct()
        {
            $this->username = "root";
            $this->password = "";
            $this->destination = "mysql:host=localhost;dbname=rgcu_sewer";

            $this->db = new PDO($this->destination, $this->username, $this->password);
        }


        public function countSewers() {
            $query = $this->db->query("SELECT * FROM sewers");
            if ($query->rowCount()<1) {
                return 0;
            } else {
                return $query->rowCount();
            }
        }


        public function getSewersID() {
            $query = $this->db->query("SELECT * FROM sewers ORDER BY card_number desc LIMIT 30");
            if ($query->rowCount()>0) {
                $sewers = $query->fetchAll(PDO::FETCH_ASSOC);
                return $sewers;
            } else {
                return false;
            }
        }


        public function getSewersIDwithFilter($q) {
            $query = $this->db->prepare("SELECT * FROM sewers s INNER JOIN (SELECT sewer_id FROM tasks t WHERE date = :date GROUP BY sewer_id) t ON s.id = t.sewer_id ORDER BY card_number desc LIMIT 50;");
            $dateParsed = date_parse($q)['year']."-".date_parse($q)['month']."-".date_parse($q)['day'];
            $query->bindParam(":date", $dateParsed);
            $query->execute();
            if ($query->rowCount()>0) {
                $sewers = $query->fetchAll(PDO::FETCH_ASSOC);
                return $sewers;
            } else {
                return false;
            }
        }

        public function getSewersIDwithFilterCounter($q) {
            $query = $this->db->prepare("SELECT * FROM sewers s INNER JOIN (SELECT sewer_id FROM tasks t WHERE date = :date GROUP BY sewer_id) t ON s.id = t.sewer_id ORDER BY card_number desc LIMIT 50;");
            $dateParsed = date_parse($q)['year']."-".date_parse($q)['month']."-".date_parse($q)['day'];
            $query->bindParam(":date", $dateParsed);
            $query->execute();
            if ($query->rowCount()>0) {
                return $query->rowCount();
            } else {
                return 0;
            }
        }

        public function getSewerItem($q) {
            $query = $this->db->query("SELECT item FROM sewers WHERE id = $q");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC)['item'];
            } else {
                return false;
            }
        }

        public function getSewerAmt($q) {
            $query = $this->db->query( "SELECT amount FROM sewers WHERE id = $q");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC)['amount'];
            } else {
                return false;
            }
        }

        public function getSewerQty($q) {
            $query = $this->db->query("SELECT quantity FROM sewers WHERE id = $q");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC)['quantity'];
            } else {
                return false;
            }
        }

        public function getSewerStatusAndEmployee($q) {
            $query = $this->db->query("SELECT if(max(date) is not null, max(date), '') as date, if(e.name is not null, e.name, \"x\") as name, if(max(date) is null, 0, t.status) as status FROM tasks t LEFT Join employees e ON t.employee = e.id WHERE t.sewer_id = $q GROUP BY t.sewer_id");
            if ($query->rowCount()>1) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public function getCardId($q) {
            $query = $this->db->query("SELECT card_number FROM sewers WHERE id = $q");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC)['card_number'];
            } else {
                return false;
            }
        }

        public function getSewerSpecificStatusAndDate($id ,$task) {
            $query = $this->db->query("SELECT t.date as date, e.name as name, t.status as status FROM tasks t LEFT Join employees e ON t.employee = e.id WHERE t.sewer_id = $id AND t.status = $task");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }


        public function searchSewerID($q) {
            $query = $this->db->query("SELECT * FROM sewers WHERE item LIKE '%$q%' OR id LIKE '%$q%' ORDER BY ID desc LIMIT 50");
            if ($query->rowCount()>0) {
                $sewers = $query->fetchAll(PDO::FETCH_ASSOC);
                return $sewers;
            }
        }

        public function addSewer($item, $card, $qty, $u_p, $amt) {
            $query = $this->db->prepare("INSERT INTO sewers (card_number, item, quantity, unit_price, amount) VALUES ($card, '$item', $qty, $u_p, $amt)");
            if ($query->execute()) {
                $sewer = $this->db->lastInsertId();
                $returnResult = true;
                $query2 = $this->db->query("SELECT * FROM statuses");
                foreach ($query2->fetchAll(PDO::FETCH_ASSOC) as $task) {
                    $query3 = $this->db->prepare("INSERT INTO tasks (sewer_id, status) VALUES (" . $sewer . ", ".$task['id'].")");
                    if ($query3->execute()) {} else $returnResult = false;
                }
                return $returnResult;
            } else {
                return $query->errorInfo();
            }
        }


        public function deleteSewer($id) {
            $query = $this->db->query("DELETE FROM sewers WHERE id = $id");
            if ($query->rowCount()>0) {
                return true;
            } else {
                return false;
            }
        }

        public function getLatestSewerID() {
            $query = $this->db->query('SELECT * FROM sewers ORDER BY id desc');
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        private function checkEmployee($item) {
            switch ($item) {
                case 0:
                    return "Removed";
                    break;

                default:
                    $query = $this->db->query("SELECT * FROM employees WHERE id = $item");
                    if ($query->rowCount()>0) {
                        return $query->fetch(PDO::FETCH_ASSOC)['name'];
                    } else {
                        return "Removed";
                    }
                    break;
            }
        }

        public function getSewerStatusById($id) {
            $query = $this->db->query("SELECT s.id as id, s.item as item, s.card_number as card_no, s.quantity as qty, s.amount as amount, t.status as status, t.employee as employee, t.date as  date FROM sewers s LEFT JOIN cards c ON s.card_number = c.id LEFT JOIN tasks t ON s.id = t.sewer_id LEFT JOIN employees e ON t.employee = e.id INNER JOIN (SELECT s.id, max(t.date) as date, t.status as status FROM sewers s LEFT JOIN cards c ON s.card_number = c.id LEFT JOIN tasks t ON s.id = t.sewer_id LEFT JOIN employees e ON t.employee = e.id WHERE t.employee IS NOT NULL GROUP BY s.id ) t2 ON t2.id = s.id AND t2.date = t.date WHERE s.id = $id ORDER BY t.date");
            if ($query->rowCount()>0) {
                $record = $query->fetch(PDO::FETCH_ASSOC);
                switch ($record['status']) {
                    case 1:
                        return "1/S-E (".$this->checkEmployee($record['employee']).")";
                        break;
                    case 2:
                        return "2/S-P (".$this->checkEmployee($record['employee']).")";
                        break;
                    case 3:
                        return "3/S-L (".$this->checkEmployee($record['employee']).")";
                        break;
                    case 4:
                        return "4/P-T (".$this->checkEmployee($record['employee']).")";
                        break;
                    case 5:
                        return "5/P-QC (".$this->checkEmployee($record['employee']).")";
                        break;
                    case 6:
                        return "6/P-P (".$this->checkEmployee($record['employee']).")";
                        break;
                    default:
                        return "7/INV";
                        break;
                }


            } else {
                return "0/NL";
            }
        }

        public function updateTask($id, $status, $employee, $date) {
            $query = $this->db->prepare("UPDATE tasks SET employee = :employee, date = :date WHERE sewer_id = $id AND status = $status");
            $null = null;
            if ($employee=="") {
                $query->bindValue(":employee", $null, PDO::PARAM_NULL);
            } else {
                $query->bindValue(":employee", $employee, PDO::PARAM_INT);
            }
            if ($date=="") {
                $query->bindValue(":date", $null, PDO::PARAM_NULL);
            } else {
                $query->bindValue(":date", date_parse($date)['year']."-".date_parse($date)['month']."-".date_parse($date)['day']);
            }
            return $query->execute();
            }
    }

    $sewerMgr = new SewerManager();