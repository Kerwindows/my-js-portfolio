<?php

function heartRateChart($array_var =[]){ ?>

<div class="col-12 col-md-6 col-xl-3 d-flex">
        <div class="card report-blk">
            <div class="card-body">
                <div class="report-head">
                    <h4><img src="<?php echo base_url() ?>/assets/img/icons/report-icon-01.svg" class="me-2" alt="">Heart Rate
                    </h4>
                </div>
                <!--<div id="heart-rate"></div>-->
                <div class="dash-content">
                    <h5><?php echo $array_var['current_user_info']['vitals']['heart_rate'] ?> <span>bpm</span></h5>
                    <!--p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs last month</p>-->
                    <p><span class="passive-view"><a href='#'>View History</a></span></p>
                </div>
            </div>
        </div>
    </div>


<?php }