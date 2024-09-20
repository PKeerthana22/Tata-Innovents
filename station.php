
<?php
session_start();
$user="root";
$password="";
$db="evehicle";
$connect=new mysqli("localhost",$user,$password,$db) or die("not connected");

$query=mysqli_query($connect,"SELECT * FROM `slots` WHERE 1 ") or die(mysqli_error($connect));
while($row=mysqli_fetch_array($query))
{   
    $s1=$row['s1'];
	$s2=$row['s2'];
	$s3=$row['s3'];
	$s4=$row['s4'];
}
if(isset($_GET['back']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="home.php";
</script>';
}
if(isset($_GET['b1']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="b1.php";
</script>';
}
if(isset($_GET['b2']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="b2.php";
</script>';
}
if(isset($_GET['b3']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="b3.php";
</script>';
}
if(isset($_GET['b4']))
{
	echo ' <script language="javascript" type="text/javascript">
parent.document.location="b4.php";
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
<h3><center>EV-Charging Stations</center></h3>

<br></div>

<br><br>
<form method="GET" action="station.php">
<div class="row1">
 
  <div class="column1">
    <div class="card1">
      <h3>EV-Station 1</h3>
	    <img src="s1.png" alt="Nature" width="30%" height="200px">
  
      <p>Available charging Slots: <?php echo $s1; ?></p>
	  
	  <p>Charger Types: DC Fast Charger</p>
	  <p>Power Output: 50 to 350 kW</p>
<p>Voltage: 400-900V DC</p>
<p>Amperage: Varies significantly depending on the charger and vehicle capabilities.</p>
<p>Charging Time: Adds about 100-200 miles of range in 30 minutes (varies greatly with higher power outputs).</p>
<p>Typical Use: Public charging stations along highways, urban areas, and major travel routes.</p>
	  
   <center><iframe src="https://maps.google.com/maps?q=10.902344663571602,76.9714621538488&hl=es;z=14&amp;output=embed" frameborder="0" width="90%" height="90%"></iframe></center>
               <br><br>
			    <button type="submit" name="b1" class="registerbtn">Book Slots</button>
 
			   
			   <br><br>    
    </div>
  </div>
  <div class="column1">
    <div class="card1">
      <h3>EV-Station 2</h3>
	    <img src="s2.png" alt="Nature" width="30%" height="200px">
  
      <p>Available charging Slots: <?php echo $s2; ?></p>
	  
	  <p>Charger Types: Type 1 Charger</p>
	  <p>Power Output: 1.2 to 1.9 kW</p>
<p>Voltage: 120V AC</p>
<p>Amperage: 12-16A</p>
<p>Charging Time: Adds about 3-5 miles of range per hour of charging.</p>
<p>Typical Use: Residential charging using a standard household outlet. </p>
   <center><iframe src="https://maps.google.com/maps?q=10.871656602175834,77.0109536481889&hl=es;z=14&amp;output=embed" frameborder="0" width="90%" height="90%"></iframe></center>
               <br><br>
			   
			    <button type="submit" name="b2" class="registerbtn">Book Slots</button>
 
			   <br><br>    
    </div>
  </div>
 
</div>
<br><br>

<div class="row1">
 
  <div class="column1">
    <div class="card1">
      <h3>EV-Station 3</h3>
	    <img src="s3.png" alt="Nature" width="30%" height="200px">
  
      <p>Available charging Slots: <?php echo $s3; ?></p>
	  
	  <p>Charger Types: Level 2 Charger</p>
	  <p>Power Output: 3.3 to 22 kW (common range is 6.6 to 11 kW)</p>
<p>Voltage: 240V AC</p>
<p>Amperage: 16-80A (common range is 30-40A)</p>
<p>Charging Time: Adds about 15-30 miles of range per hour of charging.</p>
<p>Typical Use: Residential, commercial, and public charging stations.</p>

   <center><iframe src="https://maps.google.com/maps?q=11.043690603583075,77.03574987076068&hl=es;z=14&amp;output=embed" frameborder="0" width="90%" height="90%"></iframe></center>
               <br><br>
			   
			   <button type="submit" name="b3" class="registerbtn">Book Slots</button>
 
			   <br><br>    
    </div>
  </div>
  <div class="column1">
    <div class="card1">
      <h3>EV-Station 4</h3>
	    <img src="s4.png" alt="Nature" width="30%" height="200px">
  
      <p>Available charging Slots: <?php echo $s4; ?></p>
	  
	  <p>Charger Types: Type 1 Charger</p>
	  <p>Power Output: 1.2 to 1.9 kW</p>
<p>Voltage: 120V AC</p>
<p>Amperage: 12-16A</p>
<p>Charging Time: Adds about 3-5 miles of range per hour of charging.</p>
<p>Typical Use: Residential charging using a standard household outlet. </p>
   <center><iframe src="https://maps.google.com/maps?q=11.008284791150647,77.06355722929045&hl=es;z=14&amp;output=embed" frameborder="0" width="90%" height="90%"></iframe></center>
               <br><br>
			    <button type="submit" name="b4" class="registerbtn">Book Slots</button>
 
			   
			   <br><br>    
    </div>
  </div>
 
</div>
<br><br>
</body>

</html>
