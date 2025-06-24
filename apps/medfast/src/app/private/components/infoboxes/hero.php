<?php 
function hero($array_var = []){ ?>
<div class="good-morning-blk">
    <div class="row">
        <div class="col-md-6">
            <div class="morning-user">
                <h2><?php echo  $array_var['salutation']['greeting'] ?><span><?php echo  $array_var['current_user_info']['title']." ".$array_var['current_user_info']['fname']." ".$array_var['current_user_info']['lname'] ?></span></h2>
                <p><?php echo $array_var['salutation']['gesture'] ?></p>
            </div>
        </div>
        <div class="col-md-6 position-blk">
            <div class="morning-img">
                <img src="<?php echo base_url() .  $array_var['salutation']['image'] ?>" alt="">
            </div>
        </div>
    </div>
</div>
<?php }