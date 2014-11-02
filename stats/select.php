<?php
 
// Create connection
$con=mysqli_connect("localhost","root","bitnami","health_alertdb");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT ".$_GET['attribute'] ." 
        FROM stats";

if($_GET['stat_id']){
    $sql = $sql . " WHERE stat_id = ".$_GET['stat_id'];
}

if($_GET['statName']){
    $sql = $sql . " WHERE statName = ".$_GET['statName'];
}

if($_GET['statUnit']){
    $sql = $sql . " WHERE statUnit = ".$_GET['statUnit'];
}

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
        $tempArray = $row;
        array_push($resultArray, $tempArray);
    }

    // Finally, encode the array to JSON and output the results
    echo json_encode($resultArray);
}

// Close connections
mysqli_close($result);
mysqli_close($con);
?>
