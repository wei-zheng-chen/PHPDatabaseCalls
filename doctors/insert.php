<?php

// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "INSERT INTO doctors (doctorName, doctorPhoneNumber, doctorAddress) 
		VALUES (".$_GET['doctorName'].", ".$_GET['doctorPhoneNumber'].", ".$_GET['doctorAddress'].")";

if ($con->query($sql) == TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


$patientID = $_GET['patient_id'];
$result = mysql_query("SELECT doctor_id 
			  						 FROM doctors 
			  						 WHERE doctorName = ".$_GET['doctorName']." AND 
			  						 doctorPhoneNumber = " .$_GET['doctorPhoneNumber']." AND
			  						 doctorAddress = ".$_GET['doctorAddress']);
if (!$result) {
    die('Could not query:' . mysql_error());
}

if($patientID != ""){
$sqlUpdate = "INSERT INTO patients_doctors (patient_id, doctor_id)
			  VALUES(".$patientID.", ". mysql_result($result, 0) .")";

if ($con->query($sqlUpdate) == TRUE) {
    echo "New record in patients_doctors created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


}









mysqli_close($con);

?>