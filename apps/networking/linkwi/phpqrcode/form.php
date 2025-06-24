<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=500, initial-scale=1">
<title>Ticket Purchase</title>
<style>
* {
  box-sizing: border-box;
}
h1,h2,h3,h4,h5,h6,p{
font-family:calibri,helvetica,courier,arial;
}
input[type=text],input[type=number], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}
.form-wrapper{
max-width:500px;
  margin:0 auto;
}

.form-container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>
<main class="form-wrapper">
<h2>Ticket Purchase</h2>
<p>Please full out the form below then click Purchase.</p>

<div class="form-container">
  <form  method="post" action="qrtest2.php">
  <div class="row">
    <div class="col-25">
      <label for="name">Full Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Your full name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="nooftickets">Number of Tickets</label>
    </div>
    <div class="col-75">
      <input type="number" id="nooftickets" name="nooftickets" placeholder="Ticket amount">
    </div>
  </div>

  <div class="row">
    <input name="submit" type="submit" value="Purchase">
  </div>
  </form>
</div>
</main>
</body>
</html>