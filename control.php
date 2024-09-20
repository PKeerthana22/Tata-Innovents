
<?php
session_start();
$user="root";
$password="";
$db="evehicle";
$connect=new mysqli("localhost",$user,$password,$db) or die("not connected");


if(isset($_GET['up']))
{
$query=mysqli_query($connect,"UPDATE `evcontrol` SET `con`=1 ") or die(mysqli_error($db));
}
if(isset($_GET['down']))
{
$query=mysqli_query($connect,"UPDATE `evcontrol` SET `con`=2 ") or die(mysqli_error($db));
}
if(isset($_GET['left']))
{
$query=mysqli_query($connect,"UPDATE `evcontrol` SET `con`=3 ") or die(mysqli_error($db));
}
if(isset($_GET['right']))
{
$query=mysqli_query($connect,"UPDATE `evcontrol` SET `con`=4 ") or die(mysqli_error($db));
}
if(isset($_GET['stop']))
{
$query=mysqli_query($connect,"UPDATE `evcontrol` SET `con`=0 ") or die(mysqli_error($db));
}



$query=mysqli_query($connect,"SELECT * FROM `evcontrol` WHERE 1 ") or die(mysqli_error($connect));





while($row=mysqli_fetch_array($query))
{   
    $con=$row['con'];
}

 if($con==1)
 {
     $con="EV MOVING FORWARD";
     
 }
 
 else if($con==2)
 {
     $con="EV MOVING BACKWARD";
     
 }
 
 else if($con==3)
 {
     $con="EV MOVING LEFT";
     
 }
 
 else if($con==4)
 {
     $con="EV MOVING RIGHT";
     
 }
 
 else if($con==0)
 {
     $con="EV STOPPED";
     
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
  width: 100%;
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
<form method="GET" action="control.php">
<button type="submit" name="back" >Back</button>
</form>
<br><br>
<div class="bg-img1">
<br>
<h3><center>EV Control Status</center></h3>

<br></div>

<br><br>
<form method="GET" action="control.php">
<div class="row1">
 
  <div class="column1">
    <div class="card1">
      <h3>E-Vehicle Control System</h3>
	    <img src="con.png" alt="Nature" width="30%" height="200px">
  <br><br>
      <form method="GET" action="control.php">
<button name="up">EV MOVE FORWARD</button><br><br>
<button name="down">EV MOVE BACKWARD</button><br><br>
<button name="left">EV TURN LEFT</button><br><br>
<button name="right">EV TURN RIGHT</button><br><br>
<button name="stop">EV STOP</button><br><br>
</form>
      <p>EV Status : <?php echo $con; ?></p>
    <br><br>
      
    </div>
  </div>
 
</div>
<br><br><br><br>
</body>

</html>
