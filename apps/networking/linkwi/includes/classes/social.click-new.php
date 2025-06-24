<?php
//require "../../../includes/linkwi.php";
class SocialCounts
{
    public function __construct($id)
    {
        $this->id = $id;
        $db = new dbase;
        $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $this->fetchSocial = $db->fetchMultiple();

        $db->query("SHOW COLUMNS FROM Views WHERE Field NOT IN('ID','UniqueID','total_count') ");
        $this->res = $db->fetchMultiple();
    }

    public function getSocialsArray()
    {
     $this->getRs = [];
        foreach ($this->res as $record) {
            $this->fields[] = $record['Field'];
        }
        foreach ($this->fields as $value) {
            if ($this->fetchSocial[0][$value] == 0) {
                continue;
            }
            $this->getRs[$value] = $this->fetchSocial[0][$value];
        }
        return $this->getRs;
    }
    public function getSocials()
    {
        foreach ($this->getSocialsArray() as $key => $value) { ?>

<div class="col-sm-4 col-md-3 col-6">
    <div class="info-box mb-3">
        <img class="info-box-icon " src="./images/socialicons/<?php echo $key . ".png"; ?>" alt="">
        <div class="info-box-content">
            <span class="info-box-text"><b><?php echo ucfirst($key); ?></b></span>
            <span class="info-box-number"><?php echo $value; ?></span>
        </div>
    </div>
</div>
<?php }
    }
    public function getClickMonthsArray($month, $year)
    {
        $db = new dbase;
        $query = '';
        $ans = '';
        $lastIndex = count($this->res) - 1;

	$fields = [];
	for ($x = 0; $x < count($this->res); $x++) {
	  if ($this->res[$x] != 0) {
	    $fields[] = "`" . $x . "`";  
	  }
	}
	
	$queryParts = [];
	foreach ($fields as $i => $field) {
	  $comma = ($i < $lastIndex) ? ',' : '';
	  $queryParts[] = "SUM(if(Social = '" . $this->res[$i]['Field'] ."', 1, 0)) AS $field$comma";  
	}
	
	$query .= implode(' ', $queryParts);
        $db->query("SELECT $query FROM View_Social_Stats WHERE UniqueID =:id AND MONTH(Date) =:month AND YEAR(Date)
    =:year");
        $db->bind(':id', $this->id, PDO::PARAM_STR);
        $db->bind(':month', $month, PDO::PARAM_STR);
        $db->bind(':year', $year, PDO::PARAM_STR);

        foreach ($db->fetchMultiple()[0] as $n) {
            if ($n == 0) {
                continue;
            }
            $this->m[] = $n;
        }
        return $this->m;
    }
    public function getClickMonths($month, $year)
    {
        $o = $this->getClickMonthsArray($month, $year);
        foreach ($this->getSocialsArray() as $key => $value) {
            $f = $o[1] / $value * 100; ?>
<div class="progress-group">
    <?php echo ucfirst($key) ?>
    <span class="float-right "><b><span class="<?php echo $value ?>"><?php echo $o[1] ?></span></b>/<span
            class=""><?php echo $value ?></span></span>
    <div class="progress progress-sm">
        <div class="progress-bar bg-<?php echo $value ?>" style="width:<?php echo round($f, 0) ?>%">
        </div>
    </div>
</div>
<?php    }
    }
}