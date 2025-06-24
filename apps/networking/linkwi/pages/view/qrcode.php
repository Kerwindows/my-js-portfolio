<?php
if (!defined('PROJECT_PATH')) {
 header("Location: /");
 exit();
}
?>

<section class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>My QRCode</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">QR</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /.container -->
</section>
<!--content-header-->

<section class="content">
  <div class="container">
    <div class="row" >
	<div class="card col-md-4 col-sm-6">
              <!-- /.card-header -->
             <img src="<?php echo  base_url() ?>/linkwi/phpqrcode/images/<?php echo $infouser['QRCode'];?>" alt="<?php echo $infouser['Username'];?>">
             <input class ="form-control" type="text" value="<?php echo  base_url() ?>/card/<?php echo $infouser['Username'];?>" id="myInput">
		<button class="btn btn-warning mb-3" onclick="myFunction()"><b>Copy text</b></button>
	</div>
   </div>              
</div>             

<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
 toastr.success("Url copied: " + copyText.value);
}
</script>
              <!-- /.card-body -->
              </div> </div> </div> </section>