<? 
function medicationsTable($array_var =[],$size='col-md-6'){ ?>
 
    <div class="<? echo $size ?>">
    <div class="card-box">
        <div class="card-block"> 
        <div class="patient-visit">
            <h5 class="text-bold card-title">Medications</h5>
            <button type="button" class="btn btn-link" ><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
    </div> 
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr><th></th>
                            <th>Medicine</th>
                            <th>Administered On</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($array_var['current_user_info']['medications'] as $var){
                        echo'<tr>
                            <td><i class="'.$var['icon'].'"></i></td>
                            <td>'.$var['medicine'].'</td>
                            <td>'.convert_date_time($var['administered_on'],'jS M Y').'</td>
                        </tr>';
                        }
                        ?>
                      
                    </tbody>
                </table>
                <br>
                <center><button class="custom-badge status-gray re-shedule text-danger">Report Adverse Effects</button></center>
            </div>
    </div>
</div>
                   
                       <? } ?>