

<?php

include "../config/dbconn.php"; // include connection file
include "../main/authentication.php"; // include connection file

$au = new authentication();
$filmId= $_GET['id'];



//definition of error variables

$titleErr = $descriptionErr = $yearErr = $lengthErr= '';
$err = false;

if (isset($_POST['submit'])){

 $titleinfo=$au->testInput('title');
 $err= $titleinfo[1];

 $descriptioninfo=$au->testInput('description');
 $err=$descriptioninfo[1];

 $yearInfo=$au->testInput('year');
 $err=$yearInfo[1];

 $lengthInfo=$au->testInput('length');
 $err=$lengthInfo[1];

  if(!$err) {
  $title = $au->test_input($_POST['title']);
  $description= $au->test_input($_POST['description']);
  $release_year= $au->test_input($_POST['year']);
  $length= $au->test_input($_POST['length']);

$update =  "UPDATE
              movies
            SET
              title='".$title."',
              description='".$description."',
              release_year='".$release_year."',
              length='".$length."'
           WHERE
             film_id ='$filmId'";

             $updateQuery = mysqli_query($conn,$update) or die(mysqli_error($conn));

             if($updateQuery){
               echo "<h3>The record has been updated.</h3>";
             } else {
               echo "<h3>The record has not been updated.</h3>";
             }
          }
        }

  $sql = "SELECT * FROM movies WHERE film_id='$filmId'";

  $result = mysqli_query($conn, $sql) OR die(mysqli_error($conn));


if ($result->num_rows > 0){
  while($row= mysqli_fetch_assoc($result)) {

$title = $row['title'];

$description = $row['description'];
$year = $row['release_year'];
$length = $row['length'];


  }
} else {
  echo "0 result";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select movie</title>
</head>

<body>


<form action="" method="POST">
                <br> Title: <input type="text" name='title' value="<?php echo $title; ?>"><br>
                <span><?php $err=$au->testInput('title');

                 echo $err[0];?></span>

                <br> Description <input type="text" name="description" value="<?php echo $description; ?>"><br>
                <span><?php $err=$au->testInput('description');
                  echo $err[0];?></span>
                <br> Year <input type="number" name="year" value="<?php echo $year; ?>"><br>
                <span><?php $err=$au->testInput('year');
                  echo $err[0];?></span>
                <br> Length <input type="number" name="length" value="<?php echo $length; ?>"><br>
                <span><?php $err=$au->testInput('length');
                  echo $err[0];?></span>
                 <input type="submit" name="submit" value="submit" />
            </form>

</body>
</html>
