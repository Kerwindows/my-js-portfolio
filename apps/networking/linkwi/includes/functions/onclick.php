<?php
/*

functions in this file 
Click_view()
Click_Month()
Stats()
StatsBar()
*/


//include '../classes/db.connect.php';
function Click_view($id, $button)
{
    $db = new dbase;
    $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
    $db->bind(':id', $id, PDO::PARAM_STR);
    $get_click = $db->fetchSingle();
    echo $get_click[$button];
}

function Click_Month($id, $button, $month, $year)
{
    $db = new dbase;
    $db->query("SELECT * FROM View_Social_Stats WHERE UniqueID =:id AND Social = :button AND MONTH(Date) =:month AND YEAR(Date) =:year");
    $db->bind(':id', $id, PDO::PARAM_STR);
    $db->bind(':button', $button, PDO::PARAM_STR);
    $db->bind(':month', $month, PDO::PARAM_STR);
    $db->bind(':year', $year, PDO::PARAM_STR);

    $Click_Month = $db->fetchCount();
    if ($Click_Month > 0) {
        echo $Click_Month;
    } else {

        echo "0";
    }
}


function Stats($id, $button, $month, $year)
{


    $db = new dbase;
    $db->query("SELECT * FROM View_Social_Stats WHERE UniqueID =:id AND Social = :button AND MONTH(Date) =:month AND YEAR(Date) =:year");
    $db->bind(':id', $id, PDO::PARAM_STR);
    $db->bind(':button', $button, PDO::PARAM_STR);
    $db->bind(':month', $month, PDO::PARAM_STR);
    $db->bind(':year', $year, PDO::PARAM_STR);
    $stats_info = $db->fetchSingle();
    $stats = $db->fetchCount();

    if ($stats > 0) {

        $d = $stats_info['Date'];
        $e = strtotime("$d");
        $c = date("m", $e);
        $past = $c - 1;
        $prev_months = $year . "-" . $past . "-01";
        $prevstr = strtotime("$prev_months");
        $prev_month  = date("m", $prevstr);

        $db->query("SELECT * FROM View_Social_Stats WHERE UniqueID =:id AND Social = :button AND MONTH(Date) =:month AND YEAR(Date) =:year");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $db->bind(':button', $button, PDO::PARAM_STR);
        $db->bind(':month', $prev_month, PDO::PARAM_STR);
        $db->bind(':year', $year, PDO::PARAM_STR);

        $prevstats = $db->fetchCount();

        if ($prevstats > 0) {

            $loss_gain = $stats - $prevstats;

            $final = $loss_gain / $prevstats * 100;

            if ($final > 0) {

                echo "<span class='description-percentage text-success'>".number_format((float)$final, 2, '.', '')." %<i class='fas fa-caret-up'></i></span>";
            } elseif ($final == 0) {

                echo "<span class='description-percentage text-warning'>".number_format((float)$final, 2, '.', '')." %<i class='fas fa-caret-left'></i></span>";
            } elseif ($final < 0) {

                echo "<span class='description-percentage text-danger'>".number_format((float)$final, 2, '.', '')." %<i class='fas fa-caret-down'></i></span>";
            }
        } else {

            echo "<span class='description-percentage text-danger'> N/A <i class='fas fa-caret-down'></i></span>";
        }
    } else {

        echo "<span class='description-percentage text-danger'> N/A <i class='fas fa-caret-down'></i></span>";
    }
}




function StatsBar($id, $button, $month, $year)
{

    $db = new dbase;
    $db->query("SELECT * FROM View_Social_Stats WHERE UniqueID =:id AND Social = :button AND MONTH(Date) =:month AND YEAR(Date) =:year");
    $db->bind(':id', $id, PDO::PARAM_STR);
    $db->bind(':button', $button, PDO::PARAM_STR);
    $db->bind(':month', $month, PDO::PARAM_STR);
    $db->bind(':year', $year, PDO::PARAM_STR);

    $Click_Month = $db->fetchCount();

    if ($Click_Month > 0) {
        $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $get_click = $db->fetchSingle();

        $month = $Click_Month;
        $total =  $get_click[$button];
        $percent = $month / $total * 100;
        echo $percent . "%";
    } else {

        echo "0";
    }
}