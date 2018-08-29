

<?php
include "../config/dbconn.php"; // include connection file
include "../classes/Movie.php"; // include student class
include "../main/queryToDatabase.php";

    $query = new queryToDatabase();
    $selectQuery = $query->selectAllFilms();

    if($selectQuery) { // check if the query succedded or failed
        $query->createArrayofFilmsandReturnJsonFile($selectQuery);
      }
?>

<html>
<head>
    <title>Select movie</title>
    <script src="getMovies.js"></script>
</head>

<body>

<h3><a href="insert.php">Insert a new movie to the list</a></h3>
  <div>
    <table id="listOfMovies" border="1">
             <thead>
               <tr>
                 <td>Title</td>
                 <td>Description</td>
                 <td>Release year</td>
                 <td>Length of the movie</td>
               </tr>
             </thead>
             <tbody id="listOfMoviesBody">

             </tbody>
    </table>
  </div>
</body>
</html>
