<?php

class EmployeeManager
{
    private $destination, $username, $password, $db;

    public function __construct()
    {
        $this->username = "root";
        $this->password = "";
        $this->destination = "mysql:host=localhost;dbname=rgcu_sewer";

        $this->db = new PDO($this->destination, $this->username, $this->password);
    }

    public function countEmployees()
    {
        $query = $this->db->query("SELECT * FROM employees");
        if ($query->rowCount() < 1) {
            return 0;
        } else {
            return $query->rowCount();
        }
    }

    public function getEmployees()
    {
        $query = $this->db->query("SELECT * FROM employees");
        if ($query->rowCount() > 0) {
            $employees = $query->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        }
    }

    public function getEmployeeName($id)
    {
        $query = $this->db->query("SELECT * FROM employees WHERE id = $id");
        if ($query->rowCount() > 0) {
            $employees = $query->fetch(PDO::FETCH_ASSOC);
            return $employees;
        } else {
            return false;
        }
    }

    public function searchEmployee($name)
    {
        $query = $this->db->query("SELECT * FROM employees WHERE name LIKE '%$name%'");
        if ($query->rowCount() > 0) {
            $employees = $query->fetchAll(PDO::FETCH_ASSOC);
            return $employees;
        }
    }

    public function addEmployee($name)
    {
        $query = $this->db->prepare("INSERT INTO employees (name) VALUES ('$name')");
        if ($query->execute()) {
            return true;
        } else {
            return $query->errorInfo();
        }
    }

    public function deleteEmployee($id)
    {
        $query = $this->db->query("DELETE FROM employees WHERE id = $id");
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

$employeeMgr = new EmployeeManager();