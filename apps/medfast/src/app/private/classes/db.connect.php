<?php

if (!defined('PROJECT_PATH')) {
 header("Location: ../../../../we-see-you.php");
 exit();
}
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

class dbase{
        
        // Connection properties
	    private $host;
	    private $user;
	    private $pwd;
	    private $dbname;
	
	    // Connection handler
	    private $dbh;
	
	    // Error handler
	    private $error;
	
	    // Statement handler
	    private $stmt;
	
	    // Open our connection
	    public function __construct() {
	        // Load environment configuration
	        $this->loadEnvironmentConfig();
	
	        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
	        $options = array(
	            PDO::ATTR_PERSISTENT => true,
	            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	        );
	
	        // PDO
	        try {
	            $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
	        } catch (PDOException $errorobj) {
	            $this->error = $errorobj->getMessage();
	            echo $this->error;
	        }
	    }
	
	    // Load environment configuration
	    private function loadEnvironmentConfig() {
	        if (!defined('PROJECT_PATH')) {
	            die('PROJECT_PATH is not defined.');
	        }
	        $env = include PROJECT_PATH . '/env.php';
	        if (!is_array($env)) {
	            die('env.php must return an array.');
	        }
	        $this->host = $env['DB_HOST'];
	        $this->user = $env['DB_USER'];
	        $this->pwd = $env['DB_PASS'];
	        $this->dbname = $env['DB_NAME'];
	    }
	
	//method to handle query statement
	public function query($query){
	
		$this->stmt = $this->dbh->prepare($query);
	
	}

	//method to bind values
	public function bind($param, $value, $type){
	
		$this->stmt->bindValue($param, $value, $type);
	
	}
	
	//method to execute statement
	public function execute(){
	
		return $this->stmt->execute();
	}
	
	//method to fetch single value
	public function fetchSingle(){
	
		$this->execute();
		
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
		
	}
	
	//method to fetch multiple values
	public function fetchMultiple(){
	
		$this->execute();
		
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}
	//method to fetch count
	public function fetchCount(){
	
		$this->execute();
		
		return $this->stmt->rowCount();
		
	}
	
	// Add a new method to get the last inserted ID
    	public function lastInsertId() {
        return $this->dbh->lastInsertId();
    	}
    	
    	// Assuming $this->dbh is your PDO instance inside the dbase class
	    public function beginTransaction() {
	        return $this->dbh->beginTransaction();
	    }
	
	    public function commit() {
	        return $this->dbh->commit();
	    }
	
	    public function rollBack() {
	        return $this->dbh->rollBack();
	    }
	

	// method to close the database connection
	public function closeConnection() {
		$this->dbh = null;
	}
	
}