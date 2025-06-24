<? 
function medical_missed($args=[],$size='col-12 col-md-12 col-xl-12'){ ?>
<div class="<? echo $size ?>">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">Missed</h4> <a href="appointments.html" class="patient-views float-end">Show all</a>
        </div>
        <div class="card-body p-0 table-dash">
            <div class="table-responsive">
                <table class="table mb-0 border-0  <?php echo !empty($args) ? 'datatable' :'' ?>  custom-table patient-table">
                    <thead>
                        <tr>
                            <th>Doctor name</th>
                            <th>Purpose</th>
                            <th>Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($args)) { 
                    foreach($args as $arg){ ?>
                        <tr>
                            <td class="table-image">
                                <img width="28" height="28" class="rounded-circle" src="<? echo $arg['image']; ?>" alt="">
                                <h2><? echo $arg['name']; ?></h2>
                            </td>
                            <td><? echo $arg['reason']; ?></td>
                            <td><? echo $arg['start_date']; ?></td>
                            <td><button class="custom-badge status-gray re-shedule">Reschedule</button></td>
                            <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="edit-appointment.html"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_appointment"><i
                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                        </tr>
                      <? } }  else { ?>
                        <tr>
                            <td colspan="5" class="text-center">No appointments scheduled.</td>
                        </tr>
                    <?php } ?>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<? } ?>