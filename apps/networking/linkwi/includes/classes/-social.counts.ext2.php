<?php
//require "../../../includes/linkwi.php";
class SocialCountExt2
{
  public $uniqueid;
  public $month;
  public $year;
  public function getSocialMediaArray()
  {
    $SocialMediaArray = array();
    $db = new dbase;
    $db->query("SELECT Social FROM View_Social_Stats WHERE UniqueID = '$this->uniqueid' AND MONTH(Date) = '$this->month' and YEAR(Date) = '$this->year' GROUP BY Social ORDER BY Social ");
    $getRs = $db->fetchMultiple();
    foreach ($getRs as $R) {
      if ($R['Social'] != "") {
        $SocialMediaArray[] = ucfirst($R['Social']);
      }
    }

    $this->SocialMediaArray = $SocialMediaArray;
    //return json_encode($SocialMediaArray);
    return $this->SocialMediaArray;
    $db = NULL;
  }

  public function getSocialColors()
  {
    if (!empty($this->SocialMediaArray)) {
      foreach ($this->SocialMediaArray as $value) {
        switch ($value) {
          case "Facebook":
            $color[] = '#0037c1';
            break;
          case "Instagram":
            $color[] = '#9f44b2';
            break;
          case "Linkedin":
            $color[] = '#0274b3';
            break;
          case "Tiktok":
            $color[] = '#000000';
            break;
          case "Twitter":
            $color[] = '#1d9bf0';
            break;
          case "Youtube":
            $color[] = '#ff0000';
            break;
          case "Whatsapp":
            $color[] = 'green';
            break;
          default:
            $color[] = '#007bff';
        }
      }
      return $color;
    }
  }
  public function getSocialMediaCount()
  {
    if (empty($this->SocialMediaArray)) {
      $ans = [0];
      return $ans;
    } else {
      $db = new dbase;

      $query = '';
      $ans = [];
      for ($x = 0; $x < count($this->SocialMediaArray); $x++) {

        if ($x == (count($this->SocialMediaArray) - 1)) {
          $comma = "";
        } else {
          $comma = ",";
        }

        $query .= "SUM(if(Social = '" . $this->SocialMediaArray[$x] . "', 1, 0)) AS `" . $x . "`$comma";
      }

      //echo $query;
      $db->query("SELECT $query FROM View_Social_Stats WHERE UniqueID = '$this->uniqueid' AND MONTH(Date) = '$this->month' and YEAR(Date) = '$this->year' ORDER BY Social");
      //$db->bind(':end_year', $end_year, PDO::PARAM_STR);
      //$db->bind(':class', $class, PDO::PARAM_STR);
      $getRs = $db->fetchSingle();

      //$ans .= "[";
      for ($x = 0; $x < count($getRs); $x++) {
        if ($x == (count($getRs) - 1)) {
          $comma = "";
        } else {
          $comma = ",";
        }
        $ans[] = $getRs[$x];
      }
      //$ans .= "]"; 
      return $ans;
    }
    $db = NULL;
  }









  //get social click totals

  public function combineArry()
  {
$this->getRs = [];
    $this->id = $this->uniqueid;
    $db = new dbase;
    $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
    $db->bind(':id', $this->uniqueid, PDO::PARAM_STR);
    $this->fetchSocial = $db->fetchMultiple();

    $db->query("SHOW COLUMNS FROM Views WHERE Field NOT IN('ID','UniqueID','total_count') ");
    $this->res = $db->fetchMultiple();
    $db = null;


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
$output = "";
    $a = $this->getSocialMediaArray();
    $b = $this->getSocialMediaCount();
    $newArr = [];
    $i = 0;

    if (is_null($a)) {
            $output = "";
        } else {
            if (count($a) == count($b)) {
                foreach ($a as $key => $value) {
                    $newArr[$value] = $b[$i];
                    $i++;
                }
            }
            $p = $this->getRs;
            $u = 0;

            foreach ($newArr as $key => $value) {

                $h = intval($value) / intval($p[lcfirst($key)])* 100;
                $output .= "
<div class='progress-group'>" . ucfirst($key) . "
    <span class='float-right '><b><span class='prograssbarCount $key'> $value </span></b>/<span class=''>" . $this->getRs[lcfirst($key)] . "
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
}

// $r = new SocialCountExt;
// // echo json_encode($r->combineArry());
// // echo "<br />";
// $r->uniqueid = "62abd8f6799d562abd8f6799d7";
// $r->month = '9';
// $r->year = '2022';
// echo $r->combineArry();