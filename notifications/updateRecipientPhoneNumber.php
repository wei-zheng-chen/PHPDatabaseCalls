<?php

// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$sql = "UPDATE notifications
		SET recipientPhoneNumber = ".$_GET['recipientPhoneNumber']." 
		WHERE patient_id = ".$_GET['patient_id']. 
		"AND recipientName = ".$_GET['recipientName'];


if ($con->query($sql) == TRUE) {
    echo "updated record successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

mysqli_close($con);

?>