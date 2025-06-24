<?php
class SocialCountExt
{

  public function getSocialMediaArray($uniqueid, $monthNum, $year)
  {
    $SocialMediaArray = array();
    $db = new dbase;
    $db->query("SELECT Social FROM View_Social_Stats WHERE UniqueID = '$uniqueid' AND MONTH(Date) = '$monthNum' and YEAR(Date) = '$year' GROUP BY Social ORDER BY Social ");
    $getRs = $db->fetchMultiple();
    foreach ($getRs as $R) {
      if ($R['Social'] != "") {
        $SocialMediaArray[] = ucfirst($R['Social']);
      }
    }

    $this->SocialMediaArray = $SocialMediaArray;
    //return json_encode($SocialMediaArray);
    return $SocialMediaArray;
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
  public function getSocialMediaCount($uniqueid, $monthNum, $year)
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
      $db->query("SELECT $query FROM View_Social_Stats WHERE UniqueID = '$uniqueid' AND MONTH(Date) = '$monthNum' and YEAR(Date) = '$year' ORDER BY Social");
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
}