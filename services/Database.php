<?php

namespace services;

use services\SiteConst;

class Database {
    private $host = SiteConst::HOST_ADRESS;
    private $db_name = SiteConst::DB;
    private $username = SiteConst::USER;
    private $password = SiteConst::PASSWORD;
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }


}
