<?php

/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - query()
 * - bind()
 * - execute()
 * - fetchSingle()
 * - fetchMultiple()
 * - fetchCount()
 * Classes list:
 * - dbase
 */
class dbase
{
    //connection properties
    private $host    =    "localhost";
    private $user    =    "necrodrow_erp";
    private $pwd    =    "fangking17!";
    private $dbname =    "necrodrow_erp";
    //connection handler
    private $dbh;
    //error handler
    private $error;
    //statement handler
    private $stmt;
    //open our connection
    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
            $this->dbh->exec("set names utf8mb4"); // Add this line to set the charset to utf8mb4
            //echo "Connection Successful";
        } catch (PDOException $errorobj) {
            $this->error = $errorobj->getMessage();
            echo $this->error;
        }
    }
    //method to handle query statement
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }
    //method to bind values
    public function bind($param, $value, $type)
    {
        $this->stmt->bindValue($param, $value, $type);
    }
    //method to execute statement
    public function execute()
    {
        return $this->stmt->execute();
    }
    //method to fetch single value
    public function fetchSingle()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    //method to fetch multiple values
    public function fetchMultiple()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //method to fetch count
    public function fetchCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }
    // method to close the database connection
    public function closeConnection()
    {
        $this->dbh = null;
    }
}