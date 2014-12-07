<?php

include('../ConnectionInfo.php');

// Create connection
$con=mysqli_connect($host,$username,$password,$database);

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//NOTE: write a check to see if the entry is already in the database or not
//Re-discuss if doctor_id should be autoincremented or inputted
//Discuss if doctorPhoneNumber is Unique


//insert a doct into table
$sql = "INSERT INTO doctors (doctorName, doctorPhoneNumber, doctorAddress) 
		VALUES (".$_GET['doctorName'].", ".$_GET['doctorPhoneNumber'].", ".$_GET['doctorAddress'].")";

if ($con->query($sql) == TRUE) {

    echo "New record created successfully\n";
	$patientID = $_GET['patient_id'];
//updating patients_doctors table
	if($patientID != ""){
		$sqlUpdate = "INSERT INTO patients_doctors (patient_id, doctor_id)
			  		  VALUES(".$patientID.", ". $con->insert_id .")";
		if ($con->query($sqlUpdate)) {
   	 		echo "New record in patients_doctors created successfully";
		} else {
    		echo "Error: " . $sql . "<br>" . $con->error ."\n";
    		
    		$sqlUpdate = "DELETE FROM doctors 
    					  WHERE doctor_id =" .$con->insert_id;
    		if($con->query($sqlUpdate)){
    			echo "The recently inserted doctor has been removed from the database since patients did not exist";
    		}
		}
	}

} else {
    echo "Error: " . $sql . "<br>" . $con->error;

}
//end of insert doc




mysqli_close($con);

?>
