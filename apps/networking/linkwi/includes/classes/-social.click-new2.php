<?php
//require "../../../includes/linkwi.php";
class SocialCounts2
{
    public function __construct($id, $month, $year)
    {
        $this->id = $id;
        $this->month = $month;
        $this->year = $year;
        $db = new dbase;
        $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $this->fetchSocial = $db->fetchMultiple();

        $db->query("SHOW COLUMNS FROM Views WHERE Field NOT IN('ID','UniqueID','total_count')");
        $this->res = $db->fetchMultiple();
        $db = null;
    }









    //get social click totals
    public function getSocialsArray()
    {

        foreach ($this->res as $record) {
            $this->fields[] = $record['Field'];
        }
        foreach ($this->fields as $value) {

            if ($this->fetchSocial[0][$value] == '0' || !is_numeric($this->fetchSocial[0][$value])) {
                array_pop($this->fields);
                continue;
            }

            $this->getRs[$value] = $this->fetchSocial[0][$value];
        }

        return $this->getRs;
    }










    //get totals html
    public function getSocials()
    {
        $output = "";

        foreach ($this->getSocialsArray() as $key => $value) {
            $output .= "<div class='col-sm-4 col-md-3'>
                <div class='info-box mb-3'>
                    <img class='info-box-icon' src='./images/socialicons/$key.png' alt=''>
                    <div class='info-box-content'>
                        <span class='info-box-text'><b>" . ucfirst($key) . "</b></span>
                        <span class='info-box-number'>" . $value . "</span>
                    </div>
                </div>
            </div>";
        }
        return $output;
    }










    //get social counts for the month
    public function getClickMonthsArray()
    {
        $db = new dbase;
        $query = '';
        $ans = '';
        $m = [];
        for ($x = 0; $x < count($this->res); $x++) {

            if ($x == (count($this->res) - 1)) {
                $comma = "";
            } else {
                $comma = ",";
            }
            $query .= "SUM(if(Social = '" . $this->res[$x]['Field'] . "', 1, 0)) AS `" . $x . "`$comma";
        }
        $db->query("SELECT $query FROM View_Social_Stats WHERE UniqueID =:id AND MONTH(Date) =:month AND YEAR(Date)
    =:year ORDER BY Social");
        $db->bind(':id', $this->id, PDO::PARAM_STR);
        $db->bind(':month', $this->month, PDO::PARAM_STR);
        $db->bind(':year', $this->year, PDO::PARAM_STR);
        if (is_null($db->fetchSingle()[0])) {
            $this->m[] = [];
        } else {
            foreach ($db->fetchMultiple()[0] as $n) {

                if ($n == 0) {
                    continue;
                }
                $this->m[] = $n;
            }

            return $this->m;
        }
        $db = null;
    }




    //get social counts for the month
    public function getSocialClickMonthsArray()
    {
        $db = new dbase;
        $db->query("SELECT Social FROM View_Social_Stats WHERE UniqueID =:id AND MONTH(Date) =:month AND YEAR(Date) =:year GROUP BY Social ORDER BY Social");
        $db->bind(':id', $this->id, PDO::PARAM_STR);
        $db->bind(':month', $this->month, PDO::PARAM_STR);
        $db->bind(':year', $this->year, PDO::PARAM_STR);
        $s = $db->fetchMultiple();
        $q = [];
        if (empty($s)) {
            $this->q[] = [];
        } else {
            foreach ($s as $g) {

                if ($g['Social'] == 0) {
                    continue;
                }

                $this->q[] = $g['Social'];
            }
            return $this->q;
        }
    }
    public function combineArry()
    {
        $output = "";
        $newArr = [];
        $i = 0;
        $a = $this->getSocialClickMonthsArray();
        $b = $this->getClickMonthsArray();
        if (is_null($a)) {
            $output = "";
        } else {
            if (count($a) == count($b)) {
                foreach ($a as $key => $value) {
                    $newArr[$value] = $b[$i];
                    $i++;
                }
            }
            $p = $this->getClickMonthsArray();
            $u = 0;

            foreach ($newArr as $key => $value) {

                $h = intval($p[$u]) / intval($value) * 100;
                $output .= "
<div class='progress-group'>" . ucfirst($key) . "
    <span class='float-right '><b><span class='prograssbarCount $key'> {$p[$u]} </span></b>/<span class=''>" . $this->getSocialsArray()[$key] . "
        </span></span>
    <div class='progress progress-sm'>
        <div class='progress-bar bg-$key' style='width:" . round($h, 0) . "%'>
        </div>
    </div>
</div>";
                $u++;
            }
        }
        return $output;
    }



    //get html output with click totals and grand totals
    public function getClickMonths()
    {
        $o = $this->getClickMonthsArray();
        $i = 0;
        $output = "";
        foreach ($this->getSocialsArray() as $key => $value) {
            $f = $o[$i] / $value * 100;
            $output .= "
    <div class='progress-group'>"
                . ucfirst($key) . "
        <span class='float-right '><b><span class='prograssbarCount $key'> {$o[$i]} </span></b>/<span class=''>$value
            </span></span>
        <div class='progress progress-sm'>
            <div class='progress-bar bg-$key' style='width:" . round($f, 0) . "%'>
            </div>
        </div>
    </div>";
            $i++;
        }
        return $output;
    }








    //get key with grand total values

    public function getClickMonthsValues()
    {
        foreach ($this->getSocialsArray() as $key => $value) {
            if ($value == 0) {
                continue;
            } else {
                $D[$key] = $value;
            }
        }
        return $D;
    }







    // public function getClickMonthsCount()
    // {
    //     if (empty($this->getClickMonthsArray())) {
    //         $D[] = [];
    //     } else {
    //         $o = $this->getClickMonthsArray();
    //         foreach ($this->getSocialsArray() as $key => $value) {
    //             $f = round($o[0], 0);
    //             if ($f == 0) {
    //                 continue;
    //             } else {
    //                 $D[] = $f;
    //             }
    //         }
    //         return $D;
    //     }
    // }










    public function getClickMonthsPercent()
    {
        $o = $this->getClickMonthsArray();
        foreach ($this->getSocialsArray() as $key => $value) {
            $f = round($o[0], 0);
            if ($f == 0) {
                continue;
            } else {
                $D[$key] = $f;
            }
        }
        return $D;
    }
}

///$r = new SocialCounts('62abd8f6799d562abd8f6799d7', '10', '2022');

//echo json_encode($r->getSocialsArray());
///echo "<br />";
// echo json_encode($r->getSocialClickMonthsArray());
// echo "<br />";
// echo $r->combineArry();
// echo "<br />";