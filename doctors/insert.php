<?php

// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//insert a doct into table
$sql = "INSERT INTO doctors (doctorName, doctorPhoneNumber, doctorAddress) 
		VALUES (".$_GET['doctorName'].", ".$_GET['doctorPhoneNumber'].", ".$_GET['doctorAddress'].")";

if ($con->query($sql) == TRUE) {
    echo "New record created successfully\n";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
//end of insert doc


//query for the id of the doc that has been entered
$patientID = $_GET['patient_id'];
$query = "SELECT doctor_id FROM doctors WHERE doctorName = 'JOE' AND doctorPhoneNumber = '238404034834034' AND doctorAddress = 'jack street'";

$resultArray = array();

if($result = $mysqli_query($con,$query)){
	// If so, then create a results array and a temporary one
    // to hold the data
    $tempArray = array();

    // Loop through each row in the result set
    while($row = $result->fetch_object())
    {
        // Add each row into our results array
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }
    echo "im in here";
}


echo $resultArray;

// if($patientID != "" && !empty($resultArray)){
// $sqlUpdate = "INSERT INTO patients_doctors (patient_id, doctor_id)
// 			  VALUES(".$patientID.", ". $resultArray .")";


// if ($con->query($sqlUpdate) == TRUE) {
//     echo "New record in patients_doctors created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $con->error;
// }


// }




mysqli_close($result);
mysqli_close($con);

?>