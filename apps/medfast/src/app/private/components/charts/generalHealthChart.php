<? function generalHealthChart($array_var=[],$size='col-12 col-md-12 col-xl-4 d-flex'){ 

$health_percentage = calculateHealthPercentage($array_var['current_user_info']['vitals']);
if($health_percentage==''){
$health_percentage = '';
}
?>
<div class="<?php echo $size ?>">
                <div class="card wallet-widget general-health">
                    <div class="circle-bar circle-bar2">
                        <div class="circle-graph2" data-percent="<?php echo $health_percentage ?>">
                            <b><img src="<?php echo base_url() ?>/assets/img/icons/health-img.svg" alt=""></b>
                        </div>
                    </div>
                    <div class="main-limit">
                        <p>General Health</p>
                        <h4><?php echo $health_percentage ?>%</h4>
                        <div class="income-value mt-2">
                            <!--<p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs last month</p>-->
                            <p><span class="passive-view"><a href='#'>View History</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
<? } ?>