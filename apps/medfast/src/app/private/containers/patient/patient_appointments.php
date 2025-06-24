<div class="col-sm-12">
    <div class="card card-table show-entire">
        <div class="card-body">
            <!-- Table Header -->
            <div class="page-table-header mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="doctor-table-blk">
                            <h3>Appointments</h3>
                        </div>
                    </div>
                    <div class="col-auto text-end float-end ms-auto download-grp">
                        <!-- Potential place for download buttons -->
                    </div>
                </div>
            </div>
            <!-- /Table Header -->
            <div class="table-responsive">
                <table class="table border-0 custom-table comman-table datatable datatable-default mb-0">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <div class="form-check check-tables">
                                    <input class="form-check-input" type="checkbox" value="something">
                                </div>
                            </th>
                            <th>Consulting Doctor</th>
                            <th>Reason</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($array_var['current_users_info']['appointment_details'])){
                        foreach ($array_var['current_users_info']['appointment_details'] as $data): ?>
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>                             
			        	<a class="btn btn-sm btn-default patient-visitation" href="/patient/edit-appointment/<?php echo $data['appointment_id']; ?>" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-duotone fa-user-pen"></i></a>
			        	
			        	<?php if (!in_array($data['status'], ['Missed', 'Complete', 'Cancelled'])) { ?>
                                <a class="btn btn-sm btn-default set-patient-appointment" href="/patient/visit/new/<?php echo $data['appointment_id'] ?>" title="Start Consultation" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-sharp fa-regular fa-stethoscope"></i></a>
                        <?php  } else{ ?>
                       <a class="btn btn-sm btn-default patient-conditions" href="#"   title="Cancelled" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-sharp fa-regular fa-ban"></i></a>
                      <?php  }   ?>   
                                </td>
                                
                                <td><img width="28" height="28" src="<?php echo getImagePath($data['doctor_image'])  ?>" class="rounded-circle m-r-5" alt=""> <?php echo $data['doctor_fname'].' '.$data['doctor_lname']  ?></td>
                                <td><?php echo $data['reason']; ?></td>
                                <td><a href="#"><?php echo $array_var['current_users_info']['phone']; ?></a></td>
                                <td><a href="#"><?php echo $array_var['current_users_info']['email']; ?></a></td>
                                <td><?php echo $data['start_date']; ?></td>
                                <td><?php echo $data['status']; ?></td>
                            </tr>
                        <?php endforeach; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>