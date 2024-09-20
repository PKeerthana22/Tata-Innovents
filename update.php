<?php
$db=mysqli_connect("localhost","id8659802_project","project","id8659802_project") or die(mysqli_connect_error($db));
$hb=$_GET['hb'];
$temp=$_GET['temp'];
$lat=$_GET['lat'];
$lon=$_GET['lon'];
$emer=$_GET['emer'];

$query=mysqli_query($db,"UPDATE `women_safety` SET `hb`='$hb',`temp`='$temp',`lat`='$lat',`lon`='$lon',`emer`='$emer'") or die(mysqli_error($db));
?>