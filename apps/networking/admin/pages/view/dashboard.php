<?php

//set inactive
function runInactive() {

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

//set as normal 
function runAccNormal() {
   $db = new dbase;
    $UserID = $_GET['id'];
    
   $db->query("UPDATE Users SET AccountType = '0' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
    
}
if (isset($_GET['accountnormal'])) {
   runAccNormal();
}  
//set as pro account
function runAccPro() {
    $db = new dbase;
    $UserID = $_GET['id'];
    $db->query("UPDATE Users SET AccountType = '1' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
    
}
if (isset($_GET['accountpro'])) {
   runAccPro();
} 
?>

<!-- Main content -->
<section class="content-header">
  <div class="container-fluid">
    <!--start of header row-->
    <div class='row mb-2'>
      <div class='col-sm-6'>
        <h1 class='m-0'>Registered Clients</h1> </div>
      <!-- /.col -->
      <div class='col-sm-6'>
        <ol class='breadcrumb float-sm-right'>
          <li class='breadcrumb-item'><a href='?orders' target='_blank'>View Orders</a> </li>
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
                <h3 class="card-title">Client Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Link</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Gender</th>
		    <th>Contact</th>
		    <th>Address</th>
		    <th>Date Registered</th>
		    <th>Status</th>
		    <th>Account</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                 <?php 
                 
                 
 $db = new dbase;                
$db->query("SELECT * FROM Users ORDER BY UserID DESC ");
$getUsers = $db->fetchMultiple();
$Count = $db->fetchMultiple();
$i = 0;

if ($Count > 0) {
    foreach ($getUsers as $row) {
    	$UserID = $row['UserID'];
    	$Username = $row['Username'];
	$FirstName = $row['FirstName'];
	$LastName = $row['LastName'];
	$Gender = $row['Gender'];
	$Contact = $row['Contact'];
	$Address = $row['Address'];
	$EmailAddress = $row['EmailAddress'];
	$Date = $row['Date'];
	$Active  = $row['Active'];
	$AccountType = $row['AccountType'];
	
	if($Active == 1 ){
	$Status = "<a onclick='show()' class='button button-purple' href='?dashboard&id=$UserID&inact=true'>Make Inactive</a>";
	}else{
	$Status = "<a onclick='show()' class='btn btn-primary' href='?dashboard&id=$UserID&act=true'>Make Active</a>";
	}
	
	if($AccountType == 1 ){
	$Account = "<a onclick='show()' class='button button-purple' href='?dashboard&id=$UserID&accountnormal=true'>Set to Basic</a>";
	}else{
	$Account = "<a onclick='show()' class='btn btn-primary' href='?dashboard&id=$UserID&accountpro=true'>Make Pro</a>";
	}
	
        //$StartTime = strtotime($StartTime);
        //$StartTime = date("D d M Y, h:i:s a", $StartTime);

       // $EndTime = strtotime($EndTime);
        //$EndTime = date("D d M Y, h:i:s a", $EndTime);
        $i += 1;

        print "<tr>
	<td>$i</td>
	<td><a href=\"https://linkwi.co/card/$Username\" target=\"_blank\">https://linkwi.co/card/$Username</a></td>
	<td>$FirstName</td>
	<td>$LastName</td>
	<td>$EmailAddress</td> 
	<td>$Gender</td>                  
	<td>$Contact</td>
	<td>$Address</td>
	<td>$Date</td>
	<td>$Status</td>
	<td>$Account</td>
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
       <p style='display:none' id='loading'>Loading...</p>
    <!-- /.row-->
  </div>
  <!-- /.container-fluid-->
</section>


<script>
function show() {
  var x = document.getElementById("loading");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>