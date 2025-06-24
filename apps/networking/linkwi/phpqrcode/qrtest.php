<?php
require 'qrlib.php';


$path = 'images/';
$file = $path.uniqid().".png";


$text = "David Singh";
$text .= "Ticket Count 5 ";

QRcode ::png($text,$file, 'L',10,0);



?>

<!DOCTYPE html>
<html>
<head>
<style>

.parent{
width:1200px;
height:1200px;
border:10px solid yellow;
position:relative;
background:orange;
background: url(img/checkin-qr.jpg);
background-size: 1100px 1100px, cover;
background-repeat: no-repeat;
padding-top:20px;
background-position: center;

}

.parent .child{
    position: absolute;
    left: 0px;
    top: 0px;
    bottom: 0px;
    right: 0px;
    margin: auto;
    width: 250px;
    height: 250px;
    border:1px solid yellow;
}
</style>
</head>
<body>

<?php
echo "<div class='parent'><div class='child'><img src = '".$file."'></div></div>";
?>

</body>
</html>