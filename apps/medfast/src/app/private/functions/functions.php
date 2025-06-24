<?php
function generateUniqueID($length = 32) {
    // Combine the current time (in microseconds), a random number, and a constant string
    $data = microtime() . rand(1000, 9999) . "YourConstantStringHere";
    
    // Generate a hash of the data
    $hash = hash('sha256', $data);
    
    // Return a substring of the hash, based on the desired length
    return substr($hash, 0, $length);
}



function showAge($DOB)
{
  $birth_date = strtotime($DOB);
  $now = time();
  $age = $now - $birth_date;
  $a = $age / 60 / 60 / 24 / 365.25;
  return floor($a);
}



function onsiteDot($user_id)
{
  $db = new dbase;
  $db->query("SELECT ID FROM Logs WHERE UniqueID = :user_id AND Exit_Time IS NULL AND Date = '" . date_time('Y-m-d') . "' ");
  $db->bind(':user_id', $user_id, PDO::PARAM_STR);
  if ($db->fetchCount() > 0) {
    echo '<div class="onsite-dot"></div><div class="onsite-dot onsite-dot-animation"></div>';
  } else {
    echo "";
  }
}

function teacherPositions($position)
{
  $db = new dbase;
  $db->query("SELECT staff_position FROM staff_positions");
  $get_positions = $db->fetchMultiple();
  if ($get_positions == 0) {
    echo "<option disabled></option>";
  } else {

    foreach ($get_positions as $get) {
      if ($get['staff_position'] == $position) {
        $selected = "selected";
      } else {
        $selected = "";
      }
      echo "<option $selected value='{$get['staff_position']}'>{$get['staff_position']}</option>";
    }
  }
  $db = NULL;
}

function teacherRoles($role)
{
  $db = new dbase;
  $db->query("SELECT role FROM roles WHERE (role != 'superadmin' AND role != 'parent' AND role != 'student' AND role != 'guard') ");
  $get_roles = $db->fetchMultiple();
  if ($get_roles == 0) {
    echo "<option disabled></option>";
  } else {

    foreach ($get_roles as $get) {
      if ($get['role'] == $role) {
        $selected = "selected";
      } else {
        $selected = "";
      }
      echo "<option $selected value='{$get['role']}'>{$get['role']}</option>";
    }
  }
  $db = NULL;
}




function averageWorkyr()
{
  $db = new dbase;
  $db->query("SELECT StartDate FROM staff  ");
  $get_age = $db->fetchMultiple();
  $num     = $db->fetchCount();
  if ($get_age == 0) {
    echo "No Data";
  } else {
    $integer   = 0;
    foreach ($get_age as $age) {
      $prevint   = $integer;
      $startdate = $age['StartDate'];
      $today     = date("Y-m-d");
      $diff      = date_diff(date_create($startdate), date_create($today));
      $a         = $diff->format('%y');
      $integer   = (int)$a;
      $integer += $prevint;
    }
    echo floor($integer / $num);
  }
  $db              = NULL;
}

function post_school_year()
{

  if (isset($_POST['submit'])) {
    $first_term_year = $_POST['school-year'];
    if (!preg_match('/(^[\d]{4}$)/', $first_term_year)) {
      set_error_msg('Please enter a valid year');
      header("location:?set-year");
      exit();
    }
    $sb = new dbase;
    $sb->query("UPDATE students SET FirstTermYear = :first_term_year");
    $sb->bind(':first_term_year', $first_term_year, PDO::PARAM_STR);
    if ($sb->execute()) {
      set_msg('School year changed');
      header("location:?set-year");
    }
    $sb  = NULL;
  }
}

function current_school_year()
{
  $sch = new dbase;
  $sch->query("SELECT FirstTermYear FROM students LIMIT 1");
  $get_year = $sch->fetchSingle();

  if ($get_year['FirstTermYear'] == "") {
    return "";
  } else {
    return $get_year['FirstTermYear'];
  }
  $sch     = NULL;
}
function getFormClassAward()
{
  display_msg();
  $classes = new dbase;
  $classes->query("SELECT form_class,form_class_code,form_name FROM form_classes ORDER BY form_class ASC ");
  $forms = $classes->fetchMultiple();
  if (empty($forms)) {
    echo "No Form Class Data Data";
  } else {
    foreach ($forms as $formclasses) {
    ?>

<div class="col-sm-4 col-md-2 item">
    <div class="box" style='height:128px'>
        <div class="">
            <a style="font-size:50px; " href="?awards&FormClass=<?php echo $formclasses["form_class_code"]; ?>"
                target="_blank">
                <?php echo $formclasses["form_class"]; ?> </a>
            <p class="title"><?php echo $formclasses["form_name"]; ?></p>
        </div>
    </div>
</div>
<?php }
  }
  $classes = NULL;
}


function get_formClass()
{
  display_msg();
  $classes = new dbase;
  $classes->query("SELECT id,fgroup,fnumber,fclass,form_name,Img FROM form_classes ORDER BY form_class ASC ");
  $forms = $classes->fetchMultiple();
  if ($forms == 0) {
    echo "No Form Class Data Data";
  } else {

    foreach ($forms as $formclasses) {
      if (($formclasses["Img"] == "") || (is_null($formclasses["Img"]))) {
        $formClassImg = "img/files/school-logo.png";
      } else {
        $formClassImg = "img/files/{$formclasses["Img"]}";
      }

      $formClass = $formclasses["fnumber"] . $formclasses["fclass"];
      $form_class_code = $formclasses["fgroup"].'_'.$formclasses["fnumber"] . '_' . $formclasses["fclass"];
    ?>

<div class="col-sm-4 col-md-4 item">
    <div class="box" style="background-image:url(<?php echo $formClassImg ?>)">
        <div class="cover">
            <i id="<?php echo $formclasses["id"]; ?>" data-id22="<?php echo $formclasses["id"]; ?>"
                class="population__image fas fa-image" data-toggle="modal" data-target="#modal-sm"></i>
            <a style="font-size:50px; color:white;"
                href="index.php?class=<?php echo $form_class_code; ?>"><?php echo $formClass; ?>
            </a>
            <p class="title"><?php echo $formclasses["form_name"]; ?></p>
        </div>
    </div>
</div>
<?php } ?>
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Background Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="img_form_upload" method="POST" action="<?php formImgUpload(); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <img id='output_image' class='profile_image mb-3' data-toggle='tooltip' data-placement='top'
                        title='User image' width="100px" src='img/files/school-logo.png' />
                    <input onchange="preview_image(event)" name="Img" type="file"
                        accept="image/png, image/gif, image/jpeg" data-id2="" id="fileupload">
                    <input hidden type='text' name="id" id="imageid" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btn_img_upload" id="btn_upload" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
let data;
$(document).on('click', '.population__image', function() {
    let id = $(this).data("id22");
    $.ajax({
        url: "includes/ajax/populationImage/php/edit.php",
        method: "POST",
        data: {
            id: id
        },
        dataType: "text",
        success: function(data) {
            data = JSON.parse(data);
            $('#output_image').attr('src', 'img/files/' + data.editpopImage);
            $('#fileupload').val('');
            $('#imageid').val(id);
        }
    });
});

function preview_image(event) {
    //let id = $(this).data("id2");  
    //let value = $(this).val();
    let reader = new FileReader();
    reader.onload = function() {
        let output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php }
  $classes = NULL;
}


function class_list(){
$db = new dbase;
$db->query("SELECT form_class_code FROM form_classes ORDER BY form_class");
$class_listing = $db->fetchMultiple(); 
$db->closeConnection();

foreach($class_listing as $classes){
$cla = $classes["form_class_code"];
echo '<option value="'.$cla.'" >'.formatClassCode1($cla).'</option>';
}
							   
}                                                           
      


function get_form6Class()
{
  display_msg();
  $classes = new dbase;
  $classes->query("SELECT id,fgroup,fnumber,fclass,form_name,Img FROM form6_classes ORDER BY form_class ASC ");
  $forms = $classes->fetchMultiple();
  if ($forms == 0) {
    echo "No Form Class Data Data";
  } else {

    foreach ($forms as $formclasses) {
      if (($formclasses["Img"] == "") || (is_null($formclasses["Img"]))) {
        $formClassImg = "img/files/school-logo.png";
      } else {
        $formClassImg = "img/files/{$formclasses["Img"]}";
      }
      $formClass = $formclasses["fnumber"] . $formclasses["fclass"];
      $form_class_code = $formclasses["fgroup"].'-'.$formclasses["fnumber"] . '-' . $formclasses["fclass"];
    ?>

<div class="col-sm-4 col-md-4 item">
    <div class="box" style="background-image:url(<?php echo $formClassImg ?>)">
        <div class="cover" ">
      <i id=" <?php echo $formclasses["id"]; ?>" data-id22="<?php echo $formclasses["id"]; ?>"
            class="population__image fas fa-image" data-toggle="modal" data-target="#modal-sm"></i>
            <a style="font-size:50px; color:white;"
                href="index.php?class=<?php echo $form_class_code; ?>"><?php echo $formClass; ?>
            </a>
            <p class="title"><?php echo $formclasses["form_name"]; ?></p>
        </div>
    </div>
</div>
<?php } ?>
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Background Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="img_form_upload" method="POST" action="<?php formImgUpload(); ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <img id='output_image' class='profile_image mb-3' data-toggle='tooltip' data-placement='top'
                        title='User image' width="100px" src='img/files/school-logo.png' />
                    <input onchange="preview_image(event)" name="Img" type="file"
                        accept="image/png, image/gif, image/jpeg" data-id2="" id="fileupload">
                    <input hidden type='text' name="id" id="imageid" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btn_img_upload" id="btn_upload" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type='text/javascript'>
$(document).on('click', '.population__image', function() {
    var id = $(this).data("id22");
    $.ajax({
        url: "includes/ajax/population6Image/php/edit.php",
        method: "POST",
        data: {
            id: id
        },
        dataType: "text",
        success: function(data) {
            var data = JSON.parse(data);
            $('#output_image').attr('src', 'img/files/' + data.editpopImage);
            $('#fileupload').val('');
            $('#imageid').val(id);
        }
    });
});

function preview_image(event) {
    //var id = $(this).data("id2");  
    //var value = $(this).val();
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('output_image');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
<?php }
  $classes = NULL;
}


function formImgUpload()
{
  if (isset($_POST['btn_img_upload'])) {
    if (empty($_FILES['Img']['name'])) {
    } elseif (!empty($_FILES['Img']['name'])) {

      //Create The Upload File PHP Script
      $target_file = basename($_FILES["Img"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      //Check file size
      if ($_FILES["Img"]["size"] > 500000) {
        set_error_msg("File is too large.");
        redirect($_SERVER["REQUEST_URI"]);
        exit();
      }
      //Check file type
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        set_error_msg("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        header($_SERVER["REQUEST_URI"]);
        exit();
      }

      $flpld = new dbase;
      $flpld->query("SELECT Img FROM form_classes WHERE id ='" . clean(sanitize($_POST['id'])) . "' ");
      $getImg = $flpld->fetchSingle();
      $path = "img/files/" . $getImg['Img'];
      unlink($path);

      $image   = sanitize_upload_file($_FILES['Img']['name']);
      $image     = "class-image-" . rand(9999, 99999999) . "." . $imageFileType;
      $temp_profile_pic = $_FILES['Img']['tmp_name'];
      move_uploaded_file($temp_profile_pic, "img/files/$image");

      $flpld->query("UPDATE form_classes SET Img ='$image' WHERE id='" . clean(sanitize($_POST['id'])) . "' ");
      $flpld->execute();
      $flpld = NULL;
      redirect($_SERVER["REQUEST_URI"]);
    }
  }
}

function get_Religion()
{
  $classes = new dbase;
  $classes->query("SELECT Religion FROM Religion  ");
  $forms = $classes->fetchMultiple();
  if ($forms == 0) {
    echo "No Form Class Data Data";
  } else {

    foreach ($forms as $formclasses) {

      echo $formclasses['Religion'];
    }
  }

  $classes = NULL;
}

function get_Department()
{
  $classes = new dbase;
  $classes->query("SELECT department FROM departments");
  $forms = $classes->fetchMultiple();
  if ($forms == 0) {
    echo "No Form Class Data Data";
  } else {

    foreach ($forms as $formclasses) {

      echo $formclasses['department'];
    }
  }

  $classes = NULL;
}

function checkEmptyValues($values){
    foreach($values as $value){
        if(empty($value)){
            return true;
        }
    }
    return false;
}