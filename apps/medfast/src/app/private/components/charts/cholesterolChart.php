<? function cholesterolChart($array_var=[],$size='col-12 col-md-6 col-xl-4 d-flex'){ ?>
<div class="<? echo $size ?> d-flex">
    <div class="card report-blk">
        <div class="card-body">
            <div class="report-head patient-visit">
                <h4><img src="<?php echo base_url() ?>/assets/img/icons/dep-icon-07.svg" class="me-2" alt="">Cholesterol</h4>
<button type="button" class="btn btn-link" onclick="openModal(this)" data-title='Cholesterol' data-inputname='cholesterol' ><i class="fa fa-plus" aria-hidden="true"></i></button>            </div>
            <div id=""></div>
            <div class="dash-content">
                <h5> <?php echo explode(',', $array_var['current_user_info']['vitals']['cholesterol'])[0]?? ''.'/'.explode(',', $array_var['current_user_info']['vitals']['cholesterol'])[1]?? '' ?> <span>mg/dL</span></h5>
                <!--<p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs last month</p>-->
                <p><span class="passive-view"><a href='#'>View History</a></span></p>
            </div>
        </div>
    </div>
</div>
<? } ?>