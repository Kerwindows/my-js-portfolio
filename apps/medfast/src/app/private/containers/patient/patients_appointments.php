<style>
.table-responsive{
	min-height: 250px;
	}
</style>
<div class="col-sm-12">
    <div class="card card-table show-entire">
        <div class="card-body">
            <!-- Table Header -->
            <div class="page-table-header mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="doctor-table-blk">
                            <h3>Appointments for Today</h3>
                            <div class="doctor-search-blk">
                                <div class="top-nav-search table-search-blk">
                                    <form>
                                        <input type="text" class="form-control" placeholder="Search here">
                                        <a class="btn"><img src="assets/img/icons/search-normal.svg" alt=""></a>
                                    </form>
                                </div>
                                <div class="add-group">
                                    <a href="add-patient.html" class="btn btn-primary add-pluss ms-2"><img src="assets/img/icons/plus.svg" alt=""></a>
                                    <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img src="assets/img/icons/re-fresh.svg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end float-end ms-auto download-grp">
                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-01.svg" alt=""></a>
                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-02.svg" alt=""></a>
                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-03.svg" alt=""></a>
                        <a href="javascript:;" ><img src="assets/img/icons/pdf-icon-04.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <!-- /Table Header -->
            <div class="table-responsive">
                <table class="table border-0 custom-table comman-table datatable mb-0">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <div class="form-check check-tables">
                                    <input class="form-check-input" type="checkbox" value="something">
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Consulting Doctor</th>
                            <th>Reason</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($array_var['current_users_info'] as $data): ?>
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>                             
			        	<a class="btn btn-sm btn-default patient-visitation" href="/patient/edit-appointment/<?php echo $data['id']  ?>" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-duotone fa-user-pen"></i></a>
			        	<?php if (!in_array($data['status'], ['Missed', 'Complete', 'Cancelled'])) { ?>
                                <a class="btn btn-sm btn-default set-patient-appointment" href="/patient/visit/new/<?php echo $data['id']  ?>" title="Start Consultation" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-sharp fa-regular fa-stethoscope"></i></a>
                        <?php } else{ ?>
                       <a class="btn btn-sm btn-default patient-conditions" href="#"   title="Cancelled" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa-sharp fa-regular fa-ban"></i></a>
                       <?php }    ?>   
                                </td>
                                <td class="profile-image">
                                    <a href="/patient/dashboard/<?php echo $data['patient_uid'] ?>">
                                        <img width="28" height="28" src="<?php echo empty($data['patient_image']) || is_null($data['patient_image']) ? '/assets/img/patients/default.jpg' : $data['patient_image']  ?>" class="rounded-circle m-r-5" alt="">
                                        <?php echo $data['patient_fname'] . ' ' . $data['patient_lname']; ?>
                                    </a>
                                </td>
                                <td><?php echo $data['doctor_fname'].' '.$data['doctor_lname']  ?></td>
                                <td><?php echo $data['reason']; ?></td>
                                <td><a href="#"><?php echo $data['patient_phone']; ?></a></td>
                                <td><a href="#"><?php echo $data['patient_email']; ?></a></td>
                                <td><?php echo $data['start_date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>