<?php

//set inactive
function Paid() {
    $db = new dbase;
    $UserID = $_GET['id'];
    $db->query("UPDATE Users SET Active = '0' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
    
}
if (isset($_GET['inact'])) {
   runInactive();
}
//set active
function runActive() {
   $db = new dbase;
    $UserID = $_GET['id'];
     $db->query("UPDATE Users SET Active = '1' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
    
}
if (isset($_GET['act'])) {
   runActive();
}  
  
  
?>

<!-- Main content -->
<section class="content-header">
  <div class="container-fluid">
    <!--start of header row-->
    <div class='row mb-2'>
      <div class='col-sm-6'>
        <h1 class='m-0'>Client Orders</h1> </div>
      <!-- /.col -->
      <div class='col-sm-6'>
        <ol class='breadcrumb float-sm-right'>
          <li class='breadcrumb-item'><a href='#' target='_blank'>Go To Landing Page</a> </li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /block 1-->
    <div class="row">
      <div class="col-md-12">
      
        <!-- Profile Image -->
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders For Voila Cards</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th></th>
                    
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Card Type</th>
		    <th>Card Orders</th>
		    <th>Status</th>
		    <th>Complete Order</th>
		    
		    
                  </tr>
                  </thead>
                  <tbody>
                  
                 <?php 
                 
                 
 $db = new dbase;                
$db->query("SELECT * FROM Prereg ORDER BY ID DESC ");
$count = $db->fetchCount();
$getALL = $db->fetchMultiple();
$i = 0;

if ($count> 0) {
    foreach ($getALL as $row) {
    	$ID = $row['ID'];
    	
	$FirstName = $row['FirstName'];
	$LastName = $row['LastName'];
	$Contact = $row['Contact'];
	$EmailAddress = $row['EmailAddress'];
	$CardType = $row['CardType'];
	$Status = $row['Status'];
	$Orders = $row['CardsOrdered'];
	$OrderComplete = "<a class='pt-2 pb-2 btn btn-primary' >Complete Order</a>";
	
	//$StartTime = strtotime($StartTime);
        //$StartTime = date("D d M Y, h:i:s a", $StartTime);

       // $EndTime = strtotime($EndTime);
        //$EndTime = date("D d M Y, h:i:s a", $EndTime);
        $i += 1;

        print "<tr>
	<td>$i</td>
	
	<td>$FirstName</td>
	<td>$LastName</td>
	<td>$EmailAddress</td>                
	<td>$Contact</td>
	<td>$CardType</td>
	<td>$Orders</td>
	<td>$Status</td>
	<td>$OrderComplete <a class='pt-2 pb-2 btn btn-danger' >Cancel</a></td>
	
	
	
	
	</tr>";

    }
}
?>
                  
                  
                  
                  
                 
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
    <!-- /.row-->
  </div>
  <!-- /.container-fluid-->
</section>