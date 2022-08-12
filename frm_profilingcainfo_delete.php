<?php

include "database_connection.php"; // Using database connection file here

$SID = $_GET['SID']; // get id through query string

$del = mysqli_query($dbConn,"delete from tbl_interventions where SID = '$SID'"); // delete query

if($del)
{
    mysqli_close($dbConn); // Close connection
    header("frm_profilingcainfo.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>