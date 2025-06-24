<?php class SocialClickCount
{
    public $todays_date;
    public $monthDaysCount;
    public $SocialArray;
    public $SocialArrayLC;
    public $uniqueid;
    public $month;
    public $year;
    public $getRs;
    public function __construct($uniqueid, $month, $year)
    {
        $this->SocialArray = array();
        $this->SocialArrayLC = array();
        $this->uniqueid = $uniqueid;
        $this->month = $month;
        $this->year = $year;
        $this->fetchSocialStats();
    }
    private function fetchSocialStats()
    {
        $db = new dbase;
        $query = "SELECT Social FROM View_Social_Stats WHERE UniqueID = :uniqueid AND MONTH(Date) = :month AND YEAR(Date) = :year GROUP BY Social ORDER BY Social";
        $db->query($query);
        $db->bind(':uniqueid', $this->uniqueid, PDO::PARAM_STR);
        $db->bind(':month', $this->month, PDO::PARAM_STR);
        $db->bind(':year', $this->year, PDO::PARAM_STR);
        $this->getRs = $db->fetchMultiple();
        if (!empty($this->getRs)) {
            $this->processResultSet();
        }
        $db = null;
    }
    private function processResultSet()
    {
        foreach ($this->getRs as $R) {
            if ($R['Social'] != "") {
                $this->SocialArray[] = ucfirst($R['Social']);
                $this->SocialArrayLC[] = $R['Social'];
            }
        }
    }
    public function showSocials()
    {
        return json_encode(!empty($this->SocialArray) ? $this->SocialArray : [null]);
    }
    public function getSocial()
    {
        if (empty($this->SocialArray)) {
            $fbLabel = json_encode([0]);
            return $fbLabel;
        } else {
            $query = '';
            $fbLabel = [];
            $db = new dbase;
            for ($x = 0; $x < count($this->SocialArray); $x++) {
                if ($x == (count($this->SocialArray) - 1)) {
                    $comma = "";
                } else {
                    $comma = ",";
                }
                $query .= "SUM(if(Social = '" . $this->SocialArray[$x] . "', 1, 0)) AS `" . lcfirst($this->SocialArray[$x]) . "`$comma";
            }
            $db->query("SELECT $query ,Date FROM View_Social_Stats WHERE UniqueID = '$this->uniqueid' AND MONTH(Date) = '$this->month' and YEAR(Date) = '$this->year' GROUP BY Date ORDER BY Date");
            return $this->monthDaysCountaterow = $db->fetchMultiple();
        }
    }
    public function getSocialDays()
    {
        $firstDay = max($this->todays_date - 3, 1);
        $lastDay = min($this->todays_date + 3, $this->monthDaysCount);
        return $this->monthDaysCountays = range($firstDay, $lastDay);
    }
    public function getSocialClickDays()
    {
        if (!empty($this->getSocialDays())) {
            $dataData = array_map(function ($day) {
                $suffix = 'th';
                if ($day % 10 == 1 && $day != 11) $suffix = 'st';
                if ($day % 10 == 2 && $day != 12) $suffix = 'nd';
                if ($day % 10 == 3 && $day != 13) $suffix = 'rd';
                return $day . $suffix;
            }, $this->getSocialDays());
            return json_encode($dataData);
        } else {
            return json_encode([null]);
        }
    }
    public function getSocialClickCount($Social)
    {
        $fbDate = [];
        $fb = [];
        foreach ($this->getSocial() as $datez) {
            $currentDate = set_date_time('d', $datez["Date"]);
            if (empty($fbDate) || !in_array($currentDate, $fbDate)) {
                if ($datez[$Social] != 0) {
                    $fbDate[] = $currentDate;
                    $fb[] = $datez[$Social];
                }
            }
        }
        $fbLabel = [];
        if (!empty($this->getSocialDays())) {
            foreach ($this->getSocialDays() as $number) {
                if (in_array($number, $fbDate)) {
                    $fbLabel[] = array_shift($fb);
                } else {
                    $fbLabel[] = "0";
                }
            }
            return json_encode($fbLabel);
        } else {
            return json_encode([0]);
        }
    }
    public function getEverything()
    {
        $result = [];
        if (!empty($this->SocialArrayLC)) {
            foreach ($this->SocialArrayLC as $y) {
                $result[] = $this->getSocialClickCount($y);
            }
        } else {
            $result[] = json_encode(0);
        }
        return '[' . implode(',', $result) . ']';
    }
}