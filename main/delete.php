<!-- this file shows how a simple db 'delete' operation can be done in php -->
<html>
    <head>
        <title>Simple Delete</title>
    </head>

    <body>
        <form action="" method="post">
            <input type="text" name="studId" placeholder="Student ID" /><br />
            <input type="submit" name="submit" value="Delete" /> <!-- Note that the 'value' is "Delete", so the button will appear as "Delete". -->
        </form>
    </body>
</html>

<?php
include "../config/dbconn.php"; // include connection file

if(isset($_POST["submit"])) {
    $studId = $_POST["studId"]; // get data from html form

    $deleteSQL = "DELETE FROM `student` WHERE `studId` LIKE $studId"; // delete sql
    $deleteQuery = mysqli_query($conn, $deleteSQL) or die(mysqli_error($conn)); // run sql command

    if($deleteQuery) // check if sql command succeeded
        echo "<h2>The record has been deleted.</h2>";
    else
        echo "<h2>Failed to delete the account.</h2>";
}
?>