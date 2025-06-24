<? function patientInfobox($array_var = [], $size = 'col-12 col-md-12 col-lg-12 col-xl-7')
{

    /*--calculate age from array--*/
    $dateOfBirth = $today = $interval = null;
?>

    <div class="doctor-list-blk">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <i class="fas fa-birthday-cake fa-lg" style="color: #ffffff;"></i>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><?php echo calculateAge($array_var['current_user_info']['dob']) ?></h4>
                        <h5>Age</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <i class="fas fa-users fa-lg" style="color: #ffffff;"></i>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><?php echo $array_var['current_user_info']['sex'] ?></h4>
                        <h5>Sex</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <i class="fas fa-calendar-check fa-lg" style="color: #ffffff;"></i>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><?php echo $array_var['current_user_info']['dob'] ?></h4>
                        <h5>Date of Birth</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget">
                    <div class="doctor-box-icon flex-shrink-0">
                        <i class="fas fa-weight fa-lg" style="color: #ffffff;"></i>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><?php echo $array_var['current_user_info']['blood_type'] ?></h4>
                        <h5>Blood Type</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>



<? } ?>