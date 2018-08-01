<!-- this file shows how a simple db 'update' operation can be done in php -->
<html>
<head>
    <title>Simple Delete</title>
</head>

<body>
<form action="" method="post">
    <!-- for the purpose of this tutorial, we will be updating the student's name -->
    <input type="number" name="studId" placeholder="Student ID" /><br />
    <input type="text" name="studName" placeholder="Student Name" /><br />
    <input type="submit" name="submit" value="Search" />
</form>
</body>
</html>

<?php
include "../config/dbconn.php"; // include connection file

if(isset($_POST["submit"])) {
    $studId = $_POST["studId"];
    $studName = $_POST["studName"];

    $updateSQL = "UPDATE student SET studName='$studName' WHERE studId LIKE '$studId'"; // update statement
    $updateQuery = mysqli_query($conn, $updateSQL) or die(mysqli_error($conn)); // run sql query

    if($updateQuery) // check if the query succedded or failed
        echo "<h3>The record has been updated.</h3>";
    else
        echo "<h3>The record failed to be updated.</h3>";
}
?>