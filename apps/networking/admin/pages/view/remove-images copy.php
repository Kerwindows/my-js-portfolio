<?php
//prevent external access
if (!defined('PROJECT_PATH')) {
	exit("<script>window.open('https://checkin.cyversify.com/we-see-you.php','_self')</script>");
}


if (isset($_POST["submit"])) {
	
        
		
	
}
?>


<!-- Main content -->
<section class="content-header">
  <div class="container-fluid">
    <!--start of header row-->
    <div class='row mb-2'>
      <div class='col-sm-6'>
        <h1 class='m-0'>Remove Unused Images</h1> </div>
      <!-- /.col -->
      <div class='col-sm-6'>
        <ol class='breadcrumb float-sm-right'>
          <li class='breadcrumb-item'> <a href='/profile/<?php echo $P_Username ?>' target='_blank'>Visit Page</a> </li>
          <li class='breadcrumb-item active'> <a href='?dashboard'>Dashboard</a> </li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
   
    <!-- /block 1-->
    <div class="row">
      <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-purple-addon card-outline">
          <div class="card-body box-profile">Banners<br /><br />
          <main style="display:flex;align-items:flex-start;flex-wrap:wrap">
             <?php
		     $all_files = glob("../public/assets/banners/*.*");
		  for ($i=0; $i<count($all_files); $i++)
		    {
		      $image_name = $all_files[$i];
		      $supported_format = array('gif','jpg','jpeg','png', 'webp');
		      $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
		      if (in_array($ext, $supported_format))
		          {
		            echo "<div style='display:inline-block;margin: 0 5px 5px 0;position:relative'><img src='$image_name' alt='$image_name' width='96px' style='display:inline-block'/><a href=\"?remove-images&delete=$image_name\" style='position: absolute;right: 5px;top:0;filter: drop-shadow(0 0 0.17rem white););'><i class='fa fa-window-close' aria-hidden='true'></i></a></div>";
		          } else {
		              continue;
		          }
		          if(isset($_GET['delete']))
		    {
		    $image_name = $_GET['delete'];
		    $file = str_replace("../public/assets/banners/","",$image_name);
		    
		    $image_check = "SELECT * FROM Users where User_Banner_Image = '$file' ";
					
			if (count(fetchAll($image_check)) > 0) {
		        echo "<script>alert('This image is attached to a user')</script>";
		        echo "<script>window.open('?remove-images','_self')</script>";
		        exit();
		       }
		       elseif( ($file == "parallax-1.webp") || ($file == "parallax-2.webp") || ($file == "parallax-3.webp") || ($file == "parallax-4.webp") || ($file == "parallax-5.webp") || ($file == "parallax-6.webp") || ($file == "parallax-7.webp") || ($file == "96x96.jpg") ){
		     echo "<script>alert('This image cannot be deleted')</script>";
		        echo "<script>window.open('?remove-images','_self')</script>";
		        exit();   
		       }
		       
		       else{
		       unlink($_GET['delete']);
		       echo "<script>window.open('?remove-images','_self')</script>";
		    }
		    }
		}		    
		    
		?> 
		


		 
      </div>
      <!-- /.card-body -->
    </div>
    <div class="card card-purple-addon card-outline">
          <div class="card-body box-profile">User Images<br /><br />
          <main style="display:flex;align-items:flex-start;flex-wrap:wrap">
             
		<?php
		     $all_files = glob("../public/assets/img/*.*");
		  for ($i=0; $i<count($all_files); $i++)
		    {
		      $image_name = $all_files[$i];
		      $supported_format = array('gif','jpg','jpeg','png', 'webp');
		      $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
		      if (in_array($ext, $supported_format))
		          {
		            echo "<div style='display:inline-block;margin: 0 5px 5px 0;position:relative'><img src='$image_name' alt='$image_name' width='96px' style='display:inline-block;margin-bottom:10px'/><a href=\"?remove-images&del=$image_name\" style='position: absolute;right: 5px;top:0;filter: drop-shadow(0 0 0.17rem white););'><i class='fa fa-window-close' aria-hidden='true'></i></a></div>";
		          } else {
		              continue;
		          }
		          if(isset($_GET['del'])){
		          $image_name = $_GET['del'];
		          $file = str_replace("../public/assets/img/","",$image_name);
		          $image_check = "SELECT * FROM Users where ProfileImage = '$file' OR Image_one = '$file'";
		      
			if (count(fetchAll($image_check)) > 0) {
		        echo "<script>alert('This image is attached to a user')</script>";
		        echo "<script>window.open('?remove-images','_self')</script>";
		        exit();
		       
		       }else{
		       unlink($_GET['del']);
		        header("location: ?remove-images");
		       }
		       
		    }
		    }
				    
		    
		?> 


		 
      </div>
      <!-- /.card-body -->
    </div>
    <div class="card card-purple-addon card-outline">
          <div class="card-body box-profile">User Images<br />
             <?php
		            		$image_select      = "SELECT Username,ProfileImage, Image_One, User_Banner_Image FROM Users Order By UserID";
					
					if (count(fetchAll($image_select)) > 0) {
						foreach (fetchAll($image_select) as $row_link) {
						$Username       = $row_link['Username'];
						$ProfileImage        = $row_link['ProfileImage'];
						$Image_One	= $row_link['Image_One']; 
						$User_Banner_Image	= $row_link['User_Banner_Image']; 
						
						if($ProfileImage ==""){$ProfileImage = "../public/assets/banners/96x96.jpg";}else{$ProfileImage = "../public/assets/img/$ProfileImage";}
						if($Image_One ==""){$Image_One = "../public/assets/banners/96x96.jpg";}else{$Image_One = "../public/assets/img/$Image_One";}
						if($User_Banner_Image ==""){$User_Banner_Image = "96x96.jpg";}
						
						?>
						
					
                <div style="margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;"><?php echo $Username ?><br /><img  src="<?php echo $ProfileImage ?>" alt="Profile-image" width="96px" style="display:inline-block" /><img  src="<?php echo $Image_One ?>" alt="Social Image" width="96px" style="display:inline-block" /><img  src="../public/assets/banners/<?php echo $User_Banner_Image ?>" alt="Banner-image" width="96px" style="display:inline-block"/></div>
             
                <?php	} }?>
		 
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card-outline -->
  
  </div>
  </div>
  <!-- /.row-->
  </div>
  <!-- /.container-fluid-->
</section>