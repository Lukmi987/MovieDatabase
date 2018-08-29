<?php
include "../main/queryToDatabase.php"; // include connection file
include "../classes/Movie.php";

displayImages();

function displayImages(){
  $query = new queryToDatabase();
  $conn = $query->connect();
  $movieId =intval($_POST['id']);
  $offset =intval($_POST['limit']);
var_dump($offset);
  $q = "SELECT name FROM images WHERE film_id = '$movieId' ORDER BY name  LIMIT 2 OFFSET $offset ";
  $r = mysqli_query($conn,$q);
  while($row = mysqli_fetch_assoc($r)){
      echo '<img height="300" width="300" src="'.$row['name'].'"> <br/>';
  }
mysqli_close($conn);
}

?>
