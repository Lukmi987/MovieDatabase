<!-- this file shows how a simple db 'select' operation can be done in php -->
<html>
<head>
    <title>Select movie</title>
</head>

<body>
<h3><a href="insert.php">Insert a new movie to the list</a></h3>
</body>
</html>

<?php
include "../config/dbconn.php"; // include connection file
include "../classes/Movie.php"; // include student class

    $selectSQL = "SELECT * FROM movies"; // select all
    $selectQuery = mysqli_query($conn, $selectSQL) or die(mysqli_error($conn)); // run sql query

    if($selectQuery) { // check if the query succedded or failed
        if(mysqli_num_rows($selectQuery) != 0) { // check if there are record(s)

            echo "
                <h2>Result:</h2>
                <table>
                    <thead>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Release year</td>
                        <td>Length of the movie</td>
                    </thead>
            ";


            while($row = mysqli_fetch_assoc($selectQuery)) {
                $movie = new Movie($row["film_id"],$row["title"],$row["description"],$row["release_year"],$row["length"]);
                echo "
                    <tr>

                        <td>" .$movie->getTitle() ."</td>
                        <td>" .$movie->getDescription()."</td>
                        <td>" .$movie->getReleaseYear()."</td>
                        <td>" .$movie->getLength()."</td>

                        <td><a href='UpdateMovie.php?id={$row['film_id']} '>Update</a></td>
                        <td><a href='DeleteMovie.php'><button type='button'>Delete</button></a></td>
                    </tr>
                ";
            }
            echo "</table>";
        } else
            echo "<h2>No record found.</h2>";
    }

?>
