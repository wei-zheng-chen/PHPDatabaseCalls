<?php
 
// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT contact_id
        FROM notifications
        WHERE patient_id = ".$_GET['patient_id']." AND stat_id =".$_GET['stat_id']." AND textsOn = '1'";


// Check if there are results
if ($result = mysqli_query($con, $sql))
{
    // If so, then create a results array and a temporary one
    // to hold the data
    $resultArray = array();
    $tempArray = array();

    // Loop through each row in the result set
    while($row = $result->fetch_object())
    {
        // Add each row into our results array
        $tempArray = $row->contact_id;
        array_push($resultArray, $tempArray);
    }

    var_dump($resultArray);
    //get contact
    $sql ="SELECT * 
           FROM contacts
           WHERE contact_id IN ".$resultArray ;

    if ($result = mysqli_query($con, $sql)){
    // If so, then create a results array and a temporary one
    // to hold the data
    $resultA = array();
    $tempArray = array();

    // Loop through each row in the result set
    while($row = $result->fetch_object())
    {
        // Add each row into our results array
        $tempArray = $row;
        array_push($resultA, $tempArray);
    }
        echo json_encode($resultA);

    }

    // Finally, encode the array to JSON and output the results
    // echo json_encode($resultArray);
}

// Close connections
mysqli_close($result);
mysqli_close($con);
?>
