<?php
session_start();
if(  (!isset($_SESSION['name'])) || (!isset($_SESSION['nooftickets'])) || (!isset($_SESSION['file'])) || (!isset($_SESSION["expiry"])) ){
$name = "";
$nooftickets = "";
$file = "";
}else{
$name = $_SESSION['name'];
$nooftickets = $_SESSION['nooftickets'];
$file = $_SESSION['file'];
$expiry = $_SESSION["expiry"];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=500, initial-scale=1">
<title>Ticket QR</title>
<style>
h1,h2,h3,h4,h5,h6,p{
font-family:calibri,helvetica,courier,arial;
}
.qr-wrapper{
max-width:600px;
margin:0 auto;
}

.header-title{
text-align:center;
}
.parent{
width:400px;
height:400px;
border:3px solid yellow;
border-radius:5px;
position:relative;
background:orange;
background: url(img/checkin-qr.jpg);
background-size: 1100px 1100px, cover;
background-repeat: no-repeat;
padding-top:20px;
background-position: center;
margin:0 auto;
box-sizing: border-box;

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
    border:0px solid yellow;
}

table, td, th {  
  text-align: left;
}
table {
  width: 100%;
  width: 400px;
  margin: 0 auto;
  margin-top:10px;
  background-color: #f2f2f2;
 padding:10px;
 border-radius:4px;
}

th, td {
  padding: 0px;
}
</style>
</head>
<body>
<main class="qr-wrapper">
<h2 class="header-title">Your QR</h2>
<?php
echo "<div class='parent'><div class='child'><img src = '".$file."'></div></div>"; ?>

<table>
  <tr>
    <th><p>Name</p></th>
    <th><p>Tickets</p></th>
    <th><p>Expiry</p></th>
  </tr>
  <tr>
    <td><p><?php echo "$name"; ?></p></td>
    <td><p><?php echo "$nooftickets"; ?></p></td>
    <td><p><?php echo "$expiry"; ?></p></td>
  </tr>
</table>
</main>
</body>
</html>