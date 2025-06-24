<?php function appointmentCalendar($array_vars = []){ ?>
<div class="card flex-fill mb-2">
    <div class="card-body">
        <div id="calendar-doctor" class="calendar-container"></div>
    </div>
</div>


<!--<div class="treat-box mb-2">
    <div class="user-imgs-blk">
        <img src="<?php echo base_url() ?>/assets/img/profiles/avatar-05.jpg" alt="">
        <div class="active-user-detail flex-grow-1">
            <h4>General Health Check up</h4>
            <p>Dr. Dianne Philips at 10:00-11:00 AM</p>
        </div>
    </div>
    <a href="javascript:;" class="custom-badge status-green">Active</a>
</div>
<div class="treat-box mb-2">
    <div class="user-imgs-blk">
        <img src="<?php echo base_url() ?>/assets/img/profiles/avatar-03.jpg" alt="">
        <div class="active-user-detail flex-grow-1">
            <h4>Temporary Headache </h4>
            <p>Dr. Jenny Smith at 05:00-06:00 PM</p>
        </div>
    </div>
    <a href="javascript:;" class="custom-badge status-orange">Pending</a>
</div>-->



<script nonce='<?php echo htmlspecialchars($_SESSION['nonce']) ?>'  type="text/javascript">
    // Convert PHP array to JSON and then to a JavaScript variable
    const uid = <?php echo json_encode($array_vars['current_user_info']['uid']); ?>;
</script>

<?php }