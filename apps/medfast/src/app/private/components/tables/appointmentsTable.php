<?php 

include(PRIVATE_COMPONENTS_PATH.'/tables/medicalOnSchedule.php');
include(PRIVATE_COMPONENTS_PATH.'/tables/medicalHistory.php');
include(PRIVATE_COMPONENTS_PATH.'/tables/medicalMissed.php');

function appointmentsTable($array_var = []){ ?>
<div class="col-12 col-md-12  col-xl-12">
    <div class="card-box">
    <div class="patient-visit">
        <h4 class="card-title">Appointments</h4><button type="button" class="btn btn-link" ><i style="color:tomato" class="fa fa-plus" aria-hidden="true"></i></button>
         </div>
        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
            <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-bs-toggle="tab">Appointments</a></li>
            <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-bs-toggle="tab">Past Appointments</a></li>
            <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-bs-toggle="tab">Missed Appointments</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="solid-rounded-justified-tab1">
                <? medical_on_schedule($array_var['current_user_info']['appointments']['last_3_upcoming_appointments'] ?? []); ?>
            </div>
            <div class="tab-pane" id="solid-rounded-justified-tab2">
                <? medical_history($array_var['current_user_info']['appointments']['last_3_passed_appointments'] ?? []); ?>
            </div>
            <div class="tab-pane" id="solid-rounded-justified-tab3">
                <? medical_missed($array_var['current_user_info']['appointments']['last_3_missed_appointments'] ?? []); ?>
            </div>
        </div>
    </div>
</div>
<?php }