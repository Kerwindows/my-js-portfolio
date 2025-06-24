<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
try {
    $pdo = new dbase;
    $pdo->query("SELECT start_date, end_date, summary FROM appointments WHERE uid = :uid");
    $pdo->bind(':uid',$_GET['uid'],PDO::PARAM_STR);
    $results = $pdo->fetchMultiple();
    
    $calendarEventArray = array_map(function($event) {
        return [
            'startDate' => $event['start_date'],
            'endDate' => $event['end_date'],
            'summary' => $event['summary'],
        ];
    }, $results);

    echo json_encode($calendarEventArray, JSON_PRETTY_PRINT);
    exit();

} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}