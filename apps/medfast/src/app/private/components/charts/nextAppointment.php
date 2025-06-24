<style>
.wallet-widget .circle-bar > div b {
    top: 48%;
</style>

<?php 
function nextAppointment($array_var = []) { ?>
<div class="col-12">
    <div class="card wallet-widget">
        <div class="circle-bar circle-bar2">
            <div class="circle-graph2" data-percent="66">
                <b><img src="<?php echo base_url() ?>/assets/img/icons/timer.svg" alt=""></b>
            </div>
        </div>
        <div class="main-limit">
            <p>Next Appointment in</p>
            <h4 id="nextAppointmentTime">Calculating...</h4> <!-- Dynamic content will go here -->
        </div>
    </div>
</div>
<?php 
}

// Assuming $appointments is your PHP array
$appointmentsJson = json_encode($array_var['appointments']);
?>

<script nonce="<?= htmlspecialchars($_SESSION['nonce']); ?>">
document.addEventListener('DOMContentLoaded', (event) => {
    const appointments = <?php echo $appointmentsJson; ?>;

    function findNextAppointment(appointments) {
        const now = moment.tz($time_zone);

        const futureAppointments = appointments.filter(appointment => {
            const startDate = moment.tz(appointment.start_date,$time_zone );
            return startDate > now;
        });

        futureAppointments.sort((a, b) => moment.tz(a.start_date, $time_zone) - moment.tz(b.start_date, $time_zone));

        return futureAppointments[0];
    }

    function calculateTimeDifference(appointment) {
        if (!appointment) return "No upcoming appointments.";

        const now = moment.tz($time_zone);
        const startDate = moment.tz(appointment.start_date, $time_zone);
        const diff = startDate.diff(now);

        const duration = moment.duration(diff);
        const hours = Math.floor(duration.asHours());
        const minutes = Math.floor(duration.asMinutes()) - hours * 60;

        return `${hours}h:${minutes}m`;
    }

    function updateNextAppointmentTime() {
    const nextAppointment = findNextAppointment(appointments);

    // Check if a next appointment actually exists
    if (!nextAppointment) {
        document.getElementById('nextAppointmentTime').textContent = "No upcoming appointments.";
        // Optionally, update the circle-graph to reflect the lack of appointments
        const circleGraph = document.querySelector('.circle-graph2');
        circleGraph.setAttribute('data-percent', "0");
        circleGraph.querySelector('b').textContent = `0`;
        return; // Exit the function early as there's no appointment to process
    }

    const timeToNextAppointment = calculateTimeDifference(nextAppointment);
    const now = moment.tz($time_zone);
    const startDate = moment.tz(nextAppointment.start_date, $time_zone);
    const diff = startDate.diff(now);
    const baseTime = 1 * 60 * 60 * 1000; // Adjusting base time to 1 hour in milliseconds
    const percentage = Math.min(100, (diff / baseTime) * 100).toFixed(0);

    document.getElementById('nextAppointmentTime').textContent = timeToNextAppointment;
    const circleGraph = document.querySelector('.circle-graph2');
    circleGraph.setAttribute('data-percent', percentage);
    circleGraph.querySelector('b').textContent = `${percentage}`;
}

    updateNextAppointmentTime();
    setInterval(updateNextAppointmentTime, 60000);
});

</script>