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


$db         = new dbase;
$db->query("SELECT * FROM `links` WHERE `UniqueID` = '" . custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV) . "' ORDER BY link_position");
$getLinks = $db->fetchMultiple();

function Link_OnClick($link, $id)
{

    $user_ip = getenv('REMOTE_ADDR');
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
    $country = $geo["geoplugin_countryName"];
    $city = $geo["geoplugin_city"];
    $date = date("Y-m-d");

    if (!isset($_COOKIE[$link . $id])) {
        setCookie($link . $id, 'yes', time() + (60 * 60 * 24 * 30));
        $db = new dbase;
        $db->query("UPDATE links SET link_count = link_count + 1 WHERE id =:id");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $db->execute();
    }
}

if (empty($getLinks) and !$check) { ?>
<?php } else { ?>
    <div class='links__title'>
        <h4 class="mb-30 mb-xxs-10">Links
        </h4>
        <?php if ($check) { ?>
            <div class="files__edit_dark links__edit-btn">
                <img class='links__edit-open' src="<?php echo base_url() ?>/linkwi/images/icons/edit.svg" alt="Edit" title="Edit Links">
                <i class="hide links__edit-close fas fa-times">
                </i>
            </div> <?php } ?>
    </div>
    <!-- Links -->
<?php }
foreach ($getLinks as $user_link) {
    $id = $user_link['id'];
    $link = $user_link['link_url'];
    if(empty($user_link['link_img'])){
    $url = 'https://logo.clearbit.com/'.$link;
    $imageInfo = @getimagesize($url);

if ($imageInfo === false) {
    $linkimg = base_url().'/linkwi/images/icons/link-icon.jpg';
    }else{    
    $linkimg = 'https://logo.clearbit.com/'.$link;
    }
    }else{
    $linkimg = base_url().'/linkwi/images/profile-links/'.$user_link['link_img'];
    }
?>
    <div class="link-container wow fadeInLeft col-md-6 mb-sm-20 mb-30 relative" data-id="<?php echo $user_link['id'] ?>">
<? if (!empty($getLinks) and $check) { ?> <div class="handle"><i class="fa-thin fa-grip-dots-vertical"></i></div> <? } ?>
        <div class="links">
            <div class='links__image-container'>
                <img id='image<?php echo $user_link['id'] ?>' class="links__image" src="<?php echo $linkimg ?>" alt="">
                <i data-id="<?php echo $user_link['id'] ?>" class="links__delete fa fa-trash hide"></i>
            </div>
            <p id='title<?php echo $user_link['id'] ?>' class="links__text" title="<?php echo $user_link['link_title'] ?>">
                <?php echo $user_link['link_title'] ?>
            </p>
            <a data-id="<?php echo $user_link['link_uniqueid'] ?>" id='link<?php echo $user_link['id'] ?>' class="links__right-arrow links__url linkcookieclick" href='<?php echo $user_link['link_url'] ?>' target="_blank">
                <i class="links__edit-icons fa fa-arrow-circle-right" aria-hidden="true">
                </i>
            </a>
            <button type="button" data-id="<?php echo $user_link['id'] ?>" class="hide btn btn-default links__right-arrow links__url-edit">
                <i class="links__edit-icons fa fa-pencil"></i>
            </button>
        </div>
    </div>
    <!-- End col-md-6 -->
<?php } ?>
<div class="links__add hide ">
    <i class="fas fa-plus-circle"></i>
</div>
<script>
/*
var sc = document.querySelector('script[data-id="p3PkBtuA"]');
console.log(sc);
if(document.body.contains(sc)){
sc.delete;
 }
var s = document.createElement('script');
s.src = '../js/link.profilepage.fetch.multiple.js';
document.body.appendChild(s); */
</script>

<script src="../js/link.profilepage.fetch.links.js"></script>


<script>
    function myAjax() {
        $.ajax({
            type: "POST",
            url: '../../onclick/php/onclick.php',
            data: {
                action: 'call_this'
            },
            success: function(html) {
                console.log(html);
            }

        });
    } 
     
</script>

<?php } ?>