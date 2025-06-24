<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
session_start();
require('../../../../../includes/linkwi.php');

if (custom_decrypt($_POST['chk'],SECRET_KEY,SECRET_IV)  == 1){
  $check = true;
  }
else {
    $check = false;
}

$db                  = new dbase;
$userid = custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
$db->query("SELECT * FROM User_Files WHERE UniqueID = :userid ORDER BY id");
$db->bind(':userid', $userid, PDO::PARAM_STR);
$getFiles = $db->fetchMultiple();
$getFilesCount = count($getFiles);
$db->closeConnection();

if(empty($getFiles) AND !$check ){ ?>


<?php }else{ ?>

<div class='files__title'>
    <h4 class="mb-30 mb-xxs-10">Downloads</h4>
    <?php if ($check) { ?>
        <div class="links__edit_dark files__edit-btn">
             <img class=' files__edit-open' src="<?php echo base_url() ?>/linkwi/images/icons/edit.svg" alt="Edit" title="Edit Files">
            <i class="hide files__edit-close fas fa-times"></i>
        </div> <?php } ?>
</div>

<?php } 

if (!empty($getFiles)) {

    foreach ($getFiles  as $displayFiles) {
        $id          = $displayFiles['id'];
        $icon       = $displayFiles['icons'];
        $file           = $displayFiles['files'];
        $name           = $displayFiles['name'];
        //files__url is the class that hides
?>
   
   <div class="file-container col-md-6 mb-sm-20 mb-30">
        <div class="files wow fadeInLeft">
            <div class='files__image-container'>
                <a href='<?php echo base_url() ?>/linkwi/files/<?php echo $file ?>' download='<?php echo $file ?>' class='files__url'><i class='files__url files__icon <?php echo $icon ?>'></i></a>
                <i data-id="<?php echo $displayFiles['id'] ?>" class="files__delete fa fa-trash hide"></i>
            </div>
            <a data-file-title data-id="<?php echo $displayFiles['id'] ?>" href='<?php echo base_url() ?>/linkwi/files/<?php echo $file ?>' download=' <?php echo $file ?>' class='btn-file files__text' title="<?php echo $name ?>"> <?php echo $name ?></a>
            
            <a href="<?php echo base_url() ?>/linkwi/files/<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" download="<?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-default files__right-arrow">
	        <i class="files__edit-icons files__url fas fa-cloud-download-alt"></i>
	</a>
	
            
            <button data-id="<?php echo $id ?>" class="hide btn btn-default files__url  files__right-arrow files__url-edit">
                <i class="files__edit-icons fa fa-pencil"></i>
            </button>
        </div>
    </div>
<?php
    } //end loop
} //fetch count
?>
<div class="files__add hide">
    <i class="fas fa-plus-circle">
    </i>
</div>


<script src='../js/link.profilepage.fetch.files.js'></script>

<?php } ?>