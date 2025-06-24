<?php

class SocialViews {
    public

    function __construct($id, $month, $year) {
        $db = new dbase;
        $SocialMediaArray = array();
        $db = new dbase;
        $db -> query("SELECT Social FROM View_Social_Stats WHERE UniqueID = '$id' AND MONTH(Date) = '$month' and YEAR(Date) = '$year' GROUP BY Social ORDER BY Social ");
        $getRs = $db -> fetchMultiple();
        foreach($getRs as $R) {
            if ($R['Social'] != "") {
                $SocialMediaArray[] = ucfirst($R['Social']);
            }
        }

        $this -> SocialMediaArray = $SocialMediaArray;
        ////
        if (empty($this -> SocialMediaArray)) {
            $ans = json_encode([0]);
            return $ans;
        } else {
            $db = new dbase;

            $this->query = '';
            $this->ans = [];
            for ($x = 0; $x < count($this -> SocialMediaArray); $x++) {

                if ($x == (count($this -> SocialMediaArray) - 1)) {
                    $comma = "";
                } else {
                    $comma = ",";
                }

                $this -> query .= "SUM(if(Social = '".$this -> SocialMediaArray[$x].
                "', 1, 0)) AS `".$this -> SocialMediaArray[$x].
                "`$comma";
            }

            $db -> query("SELECT $this->query FROM View_Social_Stats WHERE UniqueID = :id AND MONTH(Date) = :month and YEAR(Date) = :year ORDER BY Social");
            $db -> bind(':id', $id, PDO::PARAM_STR);
            $db -> bind(':month', $month, PDO::PARAM_STR);
            $db -> bind(':year', $year, PDO::PARAM_STR);

            $getRs = $db -> fetchSingle();
            //$this -> ans .= "[";
            for ($y = 0; $y < count($getRs); $y++) {
                $this->ans[$this->SocialMediaArray[$y]] = $getRs[$this->SocialMediaArray[$y]];
                $this->MonthlyCount[] = $getRs[$this->SocialMediaArray[$y]];
            }
            $this->MonthlySum = array_sum($this->MonthlyCount);
        
           
        }
        $db -> query("SELECT $this->query FROM View_Social_Stats WHERE UniqueID =:id AND YEAR(Date) =:year");
        $db -> bind(':id', $id, PDO::PARAM_STR);
        $db -> bind(':year', $year, PDO::PARAM_STR);
        if ($db -> fetchCount() > 0) {
            $this -> get_yearlyTotalClick = $db -> fetchSingle();
            
            for ($z = 0; $z < count($this -> get_yearlyTotalClick); $z++) {
              $this->YearlyCount[] = $this -> get_yearlyTotalClick[$this->SocialMediaArray[$z]];
            }
            $this->YearlySum = array_sum($this->YearlyCount);
            
        }
        $db -> query("SELECT $this->query FROM View_Social_Stats WHERE UniqueID =:id");
        $db -> bind(':id', $id, PDO::PARAM_STR);
        if ($db -> fetchCount() > 0) {
            $this -> get_TotalClick = $db -> fetchSingle();
            
            for ($w = 0; $w < count($this -> get_TotalClick); $w++) {
              $this->TotalCount[] = $this -> get_TotalClick[$this->SocialMediaArray[$w]];
            }
            $this->TotalSum = array_sum( $this->TotalCount);
            
        }
        $db = NULL;
    }

    public

    function getSocialCountProgressBar($social) {
        if (!empty($this -> ans[$social])) {
            $this -> {
                $social.
                'Total'
            } = $this -> get_yearlyTotalClick[$social];

            $percent = $this -> ans[$social] / $this -> {
                $social.
                'Total'
            }* 100;
            return $percent.
            "%";
        } else {
            return "0";
        }
    }
    public

    function getSocialCount($social) {
        if (!empty($this -> ans[$social])) {
            return $this -> ans[$social];
        } else {
            return "0";
        }
    }
    public

    function getTotalMonthlySocialViews() {
    if(!empty($this->MonthlySum)){
    return $this->MonthlySum;
    }else{
      return 0;
     }
     
    }
    
    public

    function getTotalYearlySocialViews() {
     if (!empty($this->YearlySum)){
     return $this->YearlySum;
     }else{
      return 0;
     }
     
    }
    
     public

    function getTotalSocialViews() {
    if(!empty($this->TotalSum)){
     return $this->TotalSum;
     }else{
      return 0;
     }
    }
}