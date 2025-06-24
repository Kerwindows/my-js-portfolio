<? function patientActiveBox($array_var=[],$size='col-12 col-md-12 col-lg-12 col-xl-7'){ ?>

<div class="treat-box mb-2">
    <div class="user-imgs-blk">
        <img src="<?php echo empty($array_var['current_user_info']['image']) || is_null($array_var['current_user_info']['image']) ? base_url().'/assets/img/patients/default.jpg' : base_url().'/'.$array_var['current_user_info']['image']  ?>"  alt="">
        <div class="active-user-detail flex-grow-1">
            <h4>Patient Profile:
                <?php echo $array_var['current_user_info']['fname'].' '.$array_var['current_user_info']['lname'] ?></h4>
            <p>Registered on <?php echo $array_var['current_user_info']['registered_on']  ?></p>
        </div>
    </div>
    <a href="#" class="custom-badge status-green">Active</a>
</div>
<? } 

function doctorActiveBox($array_var=[],$size='col-12 col-md-12 col-lg-12 col-xl-7'){ ?>

<div class="treat-box mb-2">
    <div class="user-imgs-blk">
        <img src="<?php echo base_url() . $array_var['current_user_info']['image'] ?>" alt="">
        <div class="active-user-detail flex-grow-1">
            <h4>Current Doctor Viewing Profile:
                <?php echo $array_var['current_user_info']['fname'].' '.$array_var['current_user_info']['lname'] ?></h4>
            <p>Registered on <?php echo $array_var['current_user_info']['registered_on']  ?></p>
        </div>
    </div>
    <a href="#" class="custom-badge status-green">Active</a>
</div>
<? }