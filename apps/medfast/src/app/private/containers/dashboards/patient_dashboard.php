<?php 
include(PRIVATE_COMPONENTS_PATH . '/infoboxes/patientInfobox.php'); 
include(PRIVATE_COMPONENTS_PATH . '/cards/bodyMassIndexCard.php'); 
include(PRIVATE_COMPONENTS_PATH . '/charts/staticHeathChart.php'); 
include(PRIVATE_COMPONENTS_PATH . '/charts/heartRateChart.php'); 
include(PRIVATE_COMPONENTS_PATH . '/charts/temperatureChart.php');
include(PRIVATE_COMPONENTS_PATH . '/charts/bloodPressureChart.php');
include(PRIVATE_COMPONENTS_PATH . '/charts/sleepChart.php');
include(PRIVATE_COMPONENTS_PATH . '/charts/cholesterolChart.php');
include(PRIVATE_COMPONENTS_PATH . '/charts/glucoseChart.php');
include(PRIVATE_COMPONENTS_PATH . '/charts/generalHealthChart.php');
include(PRIVATE_COMPONENTS_PATH . '/tables/appointmentsTable.php');
include(PRIVATE_COMPONENTS_PATH . '/tables/allergiesTable.php');
include(PRIVATE_COMPONENTS_PATH . '/tables/medicationsTable.php');
include(PRIVATE_COMPONENTS_PATH . '/calendars/appointmentCalendar.php');
include(PRIVATE_MODELS_PATH . '/db/getStaticHealthData.php');
//include(PRIVATE_MODELS_PATH . '/arrays/staticHealthData.php');


patientInfobox($array_var);

?>
<div class="row">

    <?php   
    staticHealthChart(getStaticHealthData($array_var['current_user_info']['uid'] ?? []));
    bodyMassIndexCard($array_var); 
    ?>
    
</div>
<div class="row">
<?php 
allergiesTable($array_var); 
medicationsTable($array_var); 

?>
</div>
<div class="row">

    <?php     
    heartRateChart($array_var);    
    temperatureChart($array_var); 
    bloodPressureChart($array_var); 
    sleepChart($array_var); 
    ?>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-xl-7">
        <div class="row">

            <?php 
            cholesterolChart($array_var);
            glucoseChart($array_var);
            generalHealthChart($array_var); 
            appointmentsTable($array_var);
            ?>
            
        </div>
    </div>
    <div class="col-12 col-md-12 col-xl-5">
        <?php appointmentCalendar($array_var); ?>
    </div>
</div>