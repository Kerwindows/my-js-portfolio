<?php
if (!defined('PROJECT_PATH')) {
 header("Location: ../../../../we-see-you.php");
 exit();
 }
 
if (isset($_GET['year'])) {
 $year = $_GET['year'];
}
else {
 $year = date_time('Y');
} 
 

?>

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Yearly Lead Statistics</b></h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                <article class="mb-2">
                        <form method="GET" action="">
                            <div class="row">

                                <div class="col-md-2">
                                <label>Year</label>
                                <input class="form-control" name="leads" hidden></input>
                                    <select class="form-control" name="year">
                                    <?php 
                                      $att = new dbase;
                                      $att->query("SELECT YEAR(Date) as years FROM Leads GROUP BY years ");
                                      $get_years = $att->fetchMultiple();
                                      foreach($get_years as $get_year){
                                      if($year == $get_year['years']){$ysel="selected";}else{$ysel="";}
                                        echo "<option $ysel>{$get_year['years']}</option>";
                                        }
                                        $att=NULL;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                <label>View</label><br>
                                    <input class="btn btn-primary" type="submit" value="Search">
                                </div>
                            </div>

                        </form>
                    </article>
                <div class="row">
                  <div class="col-12">
                    <p class="text-center">
                      <strong>Lead Chart</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="Leads" height="120" style="height: 120px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  </div>


<section class="content">
  <div class="container-fluid">
    <div class="row">
<div class="card col-12 shadow">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Contact</th>
                    <th>Area</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                   
$id = $infouser['UniqueID'];                              
$db = new dbase;                                              
$db->query("SELECT Leads.FirstName AS LFName, 
		   Leads.LastName AS LLName,
		   Leads.EmailAddress AS LEmail,
		   Leads.Contact AS LContact,
		   Leads.Met AS LMET,
		   Leads.Date AS LDate
FROM Leads INNER JOIN Users ON Leads.User_Linked = Users.UniqueID WHERE Users.UniqueID =:id "); 
$db->bind(':id', $id, PDO::PARAM_STR);  
$row_count = $db->fetchCount();                                            
$rows = $db->fetchMultiple(); 

if($row_count > 0){
 
foreach($rows as $row){		
		
			$FirstName 	= $row["LFName"];
			$LastName	= $row["LLName"];
			$Email	 	= $row["LEmail"];
			$Contact	= $row["LContact"];
			$Met		= $row["LMET"];
			$LDate		= $row["LDate"];
			
                                                
                                                 
                  print "<tr>
                  <td></td>
                    <td><b>$FirstName</b></td>
                     <td><b>$LastName</b></td>
                    <td><a href=mailto:$Email >$Email</a></td>
                    <td><a href=tel:$Contact >$Contact<a/></td>
                    <td>$Met</td>
                    <td>$LDate</td>
                 
                  </tr>";
                } }  $db = NULL;?>
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>#</th>
                   <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Contact</th>
                    <th>Area</th>
                    <th>Date</th>
                    
                    
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              </div> </div> </div> </section>
              
           
               
               
       <script>

let jan = "<?php leadStats($id,"01",$year); ?>";
let feb = "<?php leadStats($id,"02",$year); ?>";
let mar = "<?php leadStats($id,"03",$year); ?>";
let apr = "<?php leadStats($id,"04",$year); ?>";
let may = "<?php leadStats($id,"05",$year); ?>";
let jun = "<?php leadStats($id,"06",$year); ?>";
let jul = "<?php leadStats($id,"07",$year); ?>";
let aug = "<?php leadStats($id,"08",$year); ?>";
let sep = "<?php leadStats($id,"09",$year); ?>";
let oct = "<?php leadStats($id,"10",$year); ?>";
let nov = "<?php leadStats($id,"11",$year); ?>";
let dec = "<?php leadStats($id,"12",$year); ?>";




const ctx = document.getElementById('Leads');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: '# of Leads',
            data: [jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec],
            backgroundColor: [
                'rgba(46, 88, 201, 0.6)'
                
            ],
            borderColor: [
                'rgba(46, 88, 201, 1)'
                
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>