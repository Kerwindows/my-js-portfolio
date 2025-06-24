<style>
.steps-history {
    width: 66px;
}

</style>

<?php

function appointmentsTimeline($appointments) {
    date_default_timezone_set(SiteSettings::getTimeZone());// time zone set in head
    $now = new DateTime();



    // Grouping appointments by the hour of their start_date
    $groupedAppointments = [];
    foreach ($appointments as $appointment) {
        $hourKey = convert_date_time($appointment['start_date'],'h:00 A');
        $groupedAppointments[$hourKey][] = $appointment;
    }

    foreach ($groupedAppointments as $hour => $hourAppointments) {
        echo '<div class="teaching-card">';
        echo "<ul class=\"steps-history\"><li>{$hour}</li></ul>";
        echo '<ul class="activity-feed">';

        foreach ($hourAppointments as $appointment) {
            $startDateTime = new DateTime($appointment['start_date']);
            $endDateTime = new DateTime($appointment['end_date']);
            $isPast = $endDateTime < $now;
            $isOngoing = $startDateTime <= $now && $now <= $endDateTime;

            if ($isPast) {
                // Past appointment logic
                echo '<li class="feed-item d-flex align-items-center"><div class="dolor-activity hide-activity"><ul class="doctor-date-list mb-2">';
                echo '<li class="stick-line"><i class="fas fa-circle me-2"></i>' . $startDateTime->format('h:i') . ' <span>' . $appointment['patient_fname'] . ' ' . $appointment['patient_lname'] . '</span></li>';
                echo '</ul></div></li>';
            } elseif ($isOngoing) {
    // Ongoing appointment logic
    echo '<li class="feed-item d-flex align-items-center"><div class="dolor-activity"><ul class="doctor-date-list mb-2">';
    echo '<li class="dropdown ongoing-blk "><a href="#" class="dropdown-toggle active-doctor" data-bs-toggle="dropdown">';
    echo '<i class="fas fa-circle me-2 active-circles"></i>' . $startDateTime->format('h:i A') . ' <span>' . $appointment['patient_fname'] . ' ' . $appointment['patient_lname'] . '</span><span class="ongoing-drapt">Ongoing <i class="feather-chevron-down ms-2"></i></span></a>';
    // Add the dropdown details here
    echo '<ul class="doctor-sub-list dropdown-menu">';
    echo '<li class="patient-new-list dropdown-item">Patient<span>' . $appointment['patient_fname'] . ' ' . $appointment['patient_lname'] . '</span><a href="javascript:;" class="new-dot status-green"><i class="fas fa-circle me-1 fa-2xs"></i>New</a></li>';
    echo '<li class="dropdown-item">Time<span>' . $startDateTime->format('h:i A') . ' - ' . $endDateTime->format('h:i A') . ' (' . $startDateTime->diff($endDateTime)->format('%i') . 'min)</span></li>';
    echo '<li class="schedule-blk mb-0 pt-2 dropdown-item">';
    echo '<ul class="nav schedule-time">';
    echo '<li><a href="javascript:;"><img src="<?php echo base_url() ?>/assets/img/icons/trash.svg" alt=""></a></li>';
    echo '<li><a href="/patient/dashboard/'.$appointment['patient_uid'].'"><img src="<?php echo base_url() ?>/assets/img/icons/profile.svg" alt=""></a></li>';
    echo '<li><a href="/patient/edit-appointment/'.$appointment['id'].'"><img src="<?php echo base_url() ?>/assets/img/icons/edit.svg" alt=""></a></li>';
    echo '</ul>';
    echo '<a class="btn btn-primary appoint-start">Start Appointment</a>';
    echo '</li>';
    echo '</ul>'; // Closing the dropdown container
    echo '</li>'; // Closing the ongoing appointment item
    echo '</ul></div></li>';
}
 else {
                // Future appointment logic
                echo '<li class="feed-item d-flex align-items-center"><div class="dolor-activity"><ul class="doctor-date-list mb-2">';
                echo '<li><i class="fas fa-circle me-2"></i>' . $startDateTime->format('h:i') . ' <span>' . $appointment['patient_fname'] . ' ' . $appointment['patient_lname'] . '</span></li>';
                echo '</ul></div></li>';
            }
        }

        echo '</ul></div>';
    }
}
?>