<?php
session_start();

require ('../includes/databaseconnect.php');	

class Track {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  public $pdo = null;
  public $stmt = null;
  public $error = "";
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }

  // (B) DESTRUCTOR - CLOSE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) HELPER FUNCTION - EXECUTE SQL QUERY
  function query ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
  
  // (D) UPDATE RIDER COORDINATES
  function update ($someVar, $lng, $lat  ) {
  $someVar = $_SESSION['UniqueID'];
  $lic = $_SESSION['track_lic'];
  $trip = $_SESSION['trip_token'];
    return $this->query(
      "INSERT INTO `gps_track` (`rider_id`, `track_time`, `track_lng`, `track_lat`, `track_lic`, `trip_token` ) VALUES (?, ?, ?, ?, ? , ?)",
      [$someVar, DB_DATE, $lng, $lat , $lic, $trip ]
    );
  }

  // (E) GET RIDER COORDINATES
  function get ($someVar) {
  $someVar = $_SESSION['UniqueID'];
    $this->query("SELECT * FROM `gps_track` WHERE `rider_id`=?", [$someVar]);
    return $this->stmt->fetch();
  }

  // (F) GET ALL THE RIDER LOCATIONS
  function getAll () {
    $this->query("SELECT * FROM `gps_track`");
    return $this->stmt->fetchAll();
  }
}

// (G) DATABASE SETTINGS - CHANGE THESE TO YOUR OWN
/*define('DB_HOST', 'localhost');
define('DB_NAME', 'necrodrow_security');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'necrodrow_security');
define('DB_PASSWORD', '9276FAKISLF');*/


// (H) START!
$_TRACK = new Track();