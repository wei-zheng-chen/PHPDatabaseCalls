<?php

// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$doctor_id = "doctor_id"
$doctorName = "doctorName"
$doctorPhoneNumber = "doctorPhoneNumber"
$doctorAddress = "doctorAddress"

$map = [$_GET[$doctor_id], $_GET[$doctorName], $_GET[$doctorPhoneNumber], $_GET[$doctorAddress]]

print $map



$sql = "UPDATE doctors (doctor_id, doctorName, doctorPhoneNumber, doctorAddress) 
		SET (".$_GET['doctor_id'].", ".$_GET['doctorName'].", ".$_GET['doctorPhoneNumber'].", ".$_GET['doctorAddress'].")";

if ($con->query($sql) == TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

mysqli_close($con);

?>