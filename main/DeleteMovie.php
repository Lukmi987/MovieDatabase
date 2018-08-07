<?php

include "../config/dbconn.php"; // include connection file

$filmId = $_GET['id'];


$delete = "DELETE FROM movies WHERE film_id='$filmId'";
$deletequery= mysqli_query($conn,$delete) or (mysqli_error($conn));

if($deletequery){
  echo "Movie has been deleted";
} else {
  echo "Sorry try again";
}
?>
