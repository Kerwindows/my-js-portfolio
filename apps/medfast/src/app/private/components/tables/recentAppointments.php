<?php function recentAppointments($array_var = []){   ?>
<div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="/patients" class="patient-views float-end">Show all</a>
                    </div>
                    <div class="card-body p-0 table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 custom-table">
                                <tbody>
                                <?php foreach($array_var as $appointment){ ?>
                                    <tr>
                                        <td class="table-image appoint-doctor">
                                            <img width="28" height="28" class="rounded-circle" src="<?php echo getImagePath($appointment['doctor_image']) ?>" alt="">
                                            <h2><?php echo $appointment['doctor_title'].' '.$appointment['doctor_fname'].' '.$appointment['doctor_lname'] ?></h2>
                                        </td>
                                        <td class="appoint-time text-center">
                                            <h6>Today <?php echo convert_date_time($appointment['start_date'],'h:m: A') ?></h6>
                                            <span><?php echo $appointment['reason'] ?></span>
                                        </td>
                                        <td>
                                            <button class="check-point status-green me-1"><i class="feather-check"></i></button>
                                            <button class="check-point status-pink "><i class="feather-x"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
<?php }