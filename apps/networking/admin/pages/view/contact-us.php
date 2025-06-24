<div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Messages</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last name</th>
                    <th>Email Address</th>
                    <th>Contact Information</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Received On</th>
                    <th>View</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                               
                                              
                                               
                               
                                               $sql = "SELECT * FROM Contact_US                                
                                               ORDER BY ID DESC";
                                               $result = mysqli_query($conn2, $sql) or die("Bad Query: $sql");
                                               $row_count=mysqli_num_rows($result);
                               
                               
                                                 while ($row = mysqli_fetch_assoc($result)){
                                                 $ID = $row['ID'];
                                                 $FirstName = $row['FirstName'];
                                                 $LastName = $row['LastName'];
                                                 $Contact = $row['Contact'];
                                                 $EmailAddress = $row['Email'];
                                                 $Subject= $row['Subject'];
                                                 $Message= $row['Info'];
                                                 $Date= $row['Date'];
                                              
                                                
                                                 
                  print "<tr>
                    <td>$FirstName</td>
                    <td>$LastName</td>
                    <td>$Contact</td>
                    <td><a href='mailto:$EmailAddress' >$EmailAddress</a></td>
                    <td>$Subject</td>
                    <td>";echo substr(str_replace('<br />','',$Message),0,50) . "&hellip;";print"</td>
                    <td>$Date</td>
                    <td><button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modal-default$ID'>View</button></td>
                    
                   
                  </tr>
                  <div class='modal fade' id='modal-default$ID'>
			        <div class='modal-dialog'>
			          <div class='modal-content'>
			            <div class='modal-header'>
			              <h4 class='modal-title'>Message From $FirstName $LastName</h4>
			              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			                <span aria-hidden='true'>&times;</span>
			              </button>
			            </div>
			            <div class='modal-body'>
			              <p>$Message</p>
			            </div>
			            <div class='modal-footer justify-content-between'>
			              <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
			          </div>
			          <!-- /.modal-content -->
			        </div>
			        <!-- /.modal-dialog -->
			      </div>
			      <!-- /.modal -->";
                } ?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>First Name</th>
                    <th>Last name</th>
                    <th>Email Address</th>
                    <th>Contact Information</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Received On</th>
                    <th>view</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              </div>