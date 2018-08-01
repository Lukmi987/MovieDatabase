<!-- this file shows how a simple db 'select' operation can be done in php -->
<html>
<head>
    <title>Select movie</title>
</head>

<body>
<form action="" method="post">
    <!-- for the purpose of this tutorial, we will be searching the student's data based on their names -->
    <input type="text" name="studName" placeholder="Student Name" /><br />
    <input type="submit" name="submit" value="Search" />
</form>
</body>
</html>

<?php
include "../config/dbconn.php"; // include connection file
include "../classes/Student.php"; // include student class

if(isset($_POST["submit"])) {
    $studName = $_POST["studName"]; // get data from html form

    $selectSQL = "SELECT * FROM student WHERE studName LIKE '$studName'"; // select statement
    $selectQuery = mysqli_query($conn, $selectSQL) or die(mysqli_error($conn)); // run sql query

    if($selectQuery) { // check if the query succedded or failed
        if(mysqli_num_rows($selectQuery) != 0) { // check if there are record(s) or not by checking the number of rows returned
            // setup the header for the result
            echo "
                <h2>Result:</h2>
                <table>
                    <thead>
                        <td>Student ID</td>
                        <td>Student Name</td>
                        <td>Student I/C</td>
                        <td>Student Age</td>
                    </thead>
            ";

            /*
             * for each row, we will create a new <tr> to accommodate the data.
             * for each data in the row, we will create <td> to accommodate the data.
             *
             * we will extract the data for each rows in the query result.
             * for this tutorial, we are using the mysqli_fetch_assoc($queryResult) to fetch data as an
             * association in each rows.
             * mysqli_fetch_assoc($queryResult) will return data that are stored as and array of associations. this association array can only be accessed by using association method.
             * you can also use mysqli_fetch_array($queryResult) to return data that are stored as an array itself. this array can be accessed by any method, including association
             *
             * there are many ways to access array data in PHP, some of them is:
             * --> retrieving data by association: $row["studId"]. Name(association) of column are used.
             * --> retrieving data by index: $row[0]. index number of columns are used.
             */
            while($row = mysqli_fetch_assoc($selectQuery)) {
                /*
                 * $row["studId"] --> this will return the 'studId' in database
                 * $row["studName"] --> this will return the value for 'studName'
                 * $row["studIc"] --> this will return the value for 'studIc'
                 * $row["studAge"] --> this will return the value for 'studAge'
                 *
                 * we cannot directly call the variable like we did in the $selectSQL.
                 * this is because we are manipulating array data.
                 * so, you should use the 'dot'(.) operator [in java, they use '+'] to concatenate your value with the string as described below.
                 */

                // this is how we create new object in PHP
                $tempStudent = new Student($row["studId"], $row["studName"], $row["studIc"], $row["studAge"]);

                // this is how we access methods in objects in PHP
                echo "
                    <tr>
                        <td>" . $tempStudent->getStudId() . "</td>
                        <td>" . $tempStudent->getStudName() . "</td>
                        <td>" . $tempStudent->getStudIc() . "</td>
                        <td>" . $tempStudent->getStudAge() . "</td>
                    </tr>
                ";
            }
            echo "</table>";
        } else
            echo "<h2>No record found.</h2>";
    }
}
?>
