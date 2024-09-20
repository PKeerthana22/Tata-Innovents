
<?php
session_start();
$user="root";
$password="";
$db="evehicle";
$connect=new mysqli("localhost",$user,$password,$db) or die("not connected");

$query=mysqli_query($connect,"SELECT * FROM `bstatus` WHERE 1 ") or die(mysqli_error($connect));
while($row=mysqli_fetch_array($query))
{   
    $b1v=$row['b1v'];
	$b1t=$row['b1t'];
	$b1c=$row['b1c'];
    $b2v=$row['b2v'];
	$b2t=$row['b2t'];
	$b2c=$row['b2c'];
}
if($b1c==0)
{
	$b1c="Charging";
	
}
else
{
	$b1c="Discharging";
	
}
if($b2c==0)
{
	$b2c="Charging";
	
}
else
{
	$b2c="Discharging";
	
}
if(isset($_GET['back']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="home.php";
</script>';
}


?>


<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 33%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


/* Remove extra left and right margins, due to padding */
.row1 {margin: 0 -5px;}

/* Clear floats after the columns */
.row1:after {
  content: "";
  display: table;
  clear: both;
}

.column1 {
	
  float: left;
  width: 50%;
  padding: 0 10px;
}
.bg-img1 {
  /* The image used */
  width:100%;

  background-color: white;
  background-color: #FAF2F1;
border-style: redge;
}
/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
 // box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #FAF2F1;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column1 {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card1 {
 // box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: white;
   background-color: #FAF2F1;
}

.body2 {
  background-color: #474e5d;
  font-family: Helvetica, sans-serif;
}
/* The actual timeline (the vertical ruler) */
.timeline {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
  content: '';
  position: absolute;
  width: 6px;
  background-color: white;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.container {
  padding: 10px 40px;
  position: relative;
  background-color: inherit;
  width: 50%;
}

/* The circles on the timeline */
.container::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -17px;
  background-color: white;
  border: 4px solid #FF9F55;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left {
  left: 0;
}

/* Place the container to the right */
.right {
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -16px;
}

/* The actual content */
.content {
  padding: 20px 30px;
  background-color: white;
  position: relative;
  border-radius: 6px;
}

/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .timeline::after {
  left: 31px;
  }
  
  /* Full-width containers */
  .container {
  width: 100%;
  padding-left: 70px;
  padding-right: 25px;
  }
  
  /* Make sure that all arrows are pointing leftwards */
  .container::before {
  left: 60px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after, .right::after {
  left: 15px;
  }
  
  /* Make all right containers behave like the left ones */
  .right {
  left: 0%;
  }
}
</style>


</head>

<body>

<img src="ev.png" alt="Nature" class="responsive" width="100%" height="300">
<br><br>
<form method="GET" action="batteryst.php">
<button type="submit" name="back" >Back</button>
</form>
<br><br>
<div class="bg-img1">
<br>
<h3><center>Battery Status</center></h3>

<br></div>

<br><br>
<form method="GET" action="home.php">
<div class="row1">
 
  <div class="column1">
    <div class="card1">
      <h3>Battery 1 Status</h3>
	    <img src="bt1.png" alt="Nature" width="30%" height="200px">
  
      <p>Voltage: <?php echo $b1v." v";?></p>
	  
	  <p>Temperature: <?php echo $b1t." *c";?></p>
	  <p>Expected Running Time: 1 Hrs</p>
	  <p>Current Condition: <?php echo $b1c;?></p>
	  
      
    </div>
  </div>
  <div class="column1">
    <div class="card1">
      <h3>Battery 2 Status</h3>
	  <img src="bt2.png" alt="Nature" width="30%" height="200px">
  
      
      <p>Voltage: <?php echo $b2v." v";?></p>
	  <p>Temperature: <?php echo $b2t." *c";?></p>
	  <p>Expected Running Time: 1 Hrs</p>
	  <p>Current Condition: <?php echo $b2c;?></p>
	  
     </div>
  </div>
 
</div>
<br><br><br><br>
</body>

</html>
