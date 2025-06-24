<?php

/*

this page holds all functions for leads both for dashboard and front end

*/


function getLeads($id)
{

  $db = new dbase;
  $db->query("SELECT Leads.FirstName AS LFName, 
		   Leads.LastName AS LLName,
		   Leads.EmailAddress AS LEmail,
		   Leads.Contact AS LContact,
       Leads.Username AS LUsername,
		   Leads.Met AS LMET
FROM Leads INNER JOIN Users ON Leads.User_Linked = Users.UniqueID WHERE Users.UniqueID =:id LIMIT 5 ");
  $db->bind(':id', $id, PDO::PARAM_STR);


  $get_leads = $db->fetchMultiple();

  foreach ($get_leads as $leads) {

    if (!empty($leads["LUsername"])) {

      $usernameS = "<a href='" . base_url() . "/card/{$leads["LUsername"]}' target='_blank'>";
      $usernameE = "</a>";
    } else {
      $usernameS = "";
      $usernameE = "";
    }
    echo "
<tr>
<td>$usernameS" . $leads["LFName"] . " " . $leads["LLName"] . "$usernameE</td>
                      <td><a href=mailto:" . $leads["LEmail"] . ">" . $leads["LEmail"] . "</a></td>
                       <td><a href=tel:" . $leads["LContact"] . ">" . $leads["LContact"] . "</a></td>
                      <td>
                        <span class=''>" . $leads["LMET"] . "</span>
                      </td>
                      </tr>

";
  }
}




function leadStats($id, $month, $year)
{

  $db = new dbase;
  $db->query("SELECT * FROM Leads WHERE User_Linked =:id AND MONTH(Date) =:month AND YEAR(Date) =:year");
  $db->bind(':id', $id, PDO::PARAM_STR);
  $db->bind(':month', $month, PDO::PARAM_STR);
  $db->bind(':year', $year, PDO::PARAM_STR);
  $stats = $db->fetchCount();

  if ($stats > 0) {
    echo $stats;
  } else {

    echo "0";
  }
}