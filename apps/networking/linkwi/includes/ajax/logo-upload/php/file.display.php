<?php
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
?>


<div class='files__title'>
    <h4 class="mb-30 mb-xxs-10">Files</h4>
    <?php if ($check) { ?>
        <div class="links__edit_dark files__edit-btn">
             <img class=' files__edit-open' src="/linkwi/images/icons/edit.svg" alt="Edit" title="Edit Files">
            <i class="hide files__edit-close fas fa-times"></i>
        </div> <?php } ?>
</div>



<?php if ($db->fetchCount() > 0) {
    $getFiles = $db->fetchMultiple();

    foreach ($getFiles  as $displayFiles) {
        $id          = $displayFiles['id'];
        $icon       = $displayFiles['icons'];
        $file           = $displayFiles['files'];
        $name           = $displayFiles['name'];
        //files__url is the class that hides
?>
       
        
        
        
        
         <div class="col-md-6 mb-sm-20 mb-30">
        <div class="files  wow fadeInLeft">
            <div class='links__image-container'>
                <a href='https://linkwi.co/linkwi/files/<?php echo $file ?>' download='<?php echo $file ?>' class='files__url'><i class='links__url files__icon <?php echo $icon ?>'></i></a>
                <i data-id="<?php echo $displayFiles['id'] ?>" class="files__delete fa fa-trash hide"></i>
            </div>
            <a id='fileTitle<?php echo $id ?>' href='https://linkwi.co/linkwi/files/<?php echo $file ?>' download=' <?php echo $file ?>' class='btn-file text-secondary files__text'> <?php echo $name ?></a>
            
            <a class='links__right-arrow' href='https://linkwi.co/linkwi/files/<?php echo $file ?>' download=' <?php echo $file ?>'>
            <i class=" files__edit-icons files__url fas fa-cloud-download-alt"></i>
            </a>
            
            <span data-id="<?php echo $id ?>" class="hide files__url  links__right-arrow files__url-edit">
                <i class="files__edit-icons fas fa-pencil-alt"></i>
            </span>
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


<script src='../../../../../js/link.profilepage.fetch.files.js'></script>