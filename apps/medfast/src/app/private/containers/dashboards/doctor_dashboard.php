<?php
include PRIVATE_COMPONENTS_PATH . '/tables/recentAppointments.php';
include PRIVATE_COMPONENTS_PATH . '/charts/nextAppointment.php';
include PRIVATE_COMPONENTS_PATH . '/charts/appointmentsTimeline.php';
include PRIVATE_COMPONENTS_PATH . '/charts/genderChart.php';
?>
<div class="doctor-list-blk">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <div class="doctor-box-icon flex-shrink-0">
                    <img src="<?php echo base_url() ?>/assets/img/icons/doctor-dash-01.svg" alt="">
                </div>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">30</span><span>/85</span><span class="status-green">+60%</span></h4>
                    <h5>Appointments</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <div class="doctor-box-icon flex-shrink-0">
                    <img src="<?php echo base_url() ?>/assets/img/icons/doctor-dash-02.svg" alt="">
                </div>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">20</span><span>/125</span><span class="status-pink">-20%</span></h4>
                    <h5>Consultations</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <div class="doctor-box-icon flex-shrink-0">
                    <img src="<?php echo base_url() ?>/assets/img/icons/doctor-dash-03.svg" alt="">
                </div>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">12</span><span>/30</span><span class="status-green">+40%</span></h4>
                    <h5>Operations</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget">
                <div class="doctor-box-icon flex-shrink-0">
                    <img src="<?php echo base_url() ?>/assets/img/icons/doctor-dash-04.svg" alt="">
                </div>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4>$<span class="counter-up">530</span><span></span><span class="status-green">+50%</span></h4>
                    <h5>Earnings</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12  col-xl-7">
        <div class="row">
            <div class="col-12 col-md-12  col-xl-8">
                <?php echo recentAppointments($array_var['appointments']); ?>
            </div>
            <div class="col-12 col-md-12  col-xl-4 d-flex">
                <div class="row">
                    <?php echo nextAppointment($array_var['appointments']); ?>

                    <?php echo genderChart(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12 col-xl-5 d-flex">
        <div class="card flex-fill comman-shadow">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Recent Appointments</h4> <a href="/appointments" class="patient-views float-end">Show all</a>
            </div>
            <div class="card-body">
            <?php echo appointmentsTimeline($array_var['appointments']); ?>
            </div>
        </div>
    </div>
</div>