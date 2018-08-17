<?php

include "../main/queryToDatabase.php"; // include connection file
 // include connection file

$au = new authentication();
$query = new queryToDatabase();
$err = false;

if (isset($_POST['submit'])){
  $err = $au->testInput();
  if(!$err) {
  $update = $query->updateFilm();
  $wasItsave = $query->verifyInsertSuccess($update);
  echo $wasItsave;
  }
}

$result = $query->selectFilm();
//fill the variables for the input fields of the form with the current movie
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
//php par for ajax, getting imgs from db
$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file

?>


<!DOCTYPE html>
<html>
<head>
    <title>Select movie</title>
</head>

<body>


<form action="" method="POST">
                <br> Title: <input type="text" name='title' value="<?php echo $title; ?>"><br>

                <span> <?php echo $titleErr ?><span>
                <br> Description <input type="text" name="description" value="<?php echo $description; ?>"><br>

                <br> Year <input type="number" name="year" value="<?php echo $year; ?>"><br>

                <br> Length <input type="number" name="length" value="<?php echo $length; ?>"><br>

                 <input type="submit" name="submit" value="submit" />
            </form>

</body>
</html>
