<?php
// require "../../../includes/linkwi.php"; -->
class SocialCounts
{
    public function __construct($id)
    {
        $db = new dbase;
        $db->query("SELECT * FROM Views WHERE UniqueID =:id ");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $this->fetchSocial = $db->fetchMultiple();

        $db->query("SHOW COLUMNS FROM Views WHERE Field NOT IN('ID','UniqueID','total_count') ");
        $this->res = $db->fetchMultiple();
    }

    public function getSocials()
    {


        foreach ($this->res as $record) {
            $fields[] = $record['Field'];
        }
        foreach ($fields as $value) {
            if ($this->fetchSocial[0][$value] == 0) {
                continue;
            }

?>

            <div class="col-sm-4 col-md-3">
                <div class="info-box mb-3">
                    <img class="info-box-icon " src="./images/socialicons/<?php echo $value . ".png"; ?>" alt="">
                    <div class="info-box-content">
                        <span class="info-box-text"><b><?php echo ucfirst($value); ?></b></span>
                        <span class="info-box-number"><?php echo $this->fetchSocial[0][$value]; ?></span>
                    </div>
                </div>
            </div>
<?php }
    }
}
