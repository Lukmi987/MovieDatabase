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


<html>
<head>
    <title>Select movie</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

      <form action="" method="POST">
                <br> Title: <input type="text" name='title' value="<?php echo $title; ?>"><br>


                <br> Description <input type="text" name="description" value="<?php echo $description; ?>"><br>

                <br> Year <input type="number" name="year" value="<?php echo $year; ?>"><br>

                <br> Length <input type="number" name="length" value="<?php echo $length; ?>"><br><br>
                  <span><?php if($err){
                    echo 'Fill the empty fields pls';
                    }
                  ?></span>
                 <input type="submit" name="submit" value="submit" /><br>
      </form> <br>

      <h2> Save a new image</h2>
      <?php
        ini_set('mysql.connect_timeout',300);
        ini_set('default_socket_timeout',300);
       ?>
      <form method="post" enctype="multipart/form-data">
        <br/>
          <input type="file" name="image" />
          <br/> <br/>
          <input type="submit" name="sub" value="upload" />
      </form>
    <?php
        if(isset($_POST['sub'])){
          if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
          {
              echo "Please selcet a picture";
          }
          else {
            $image = addslashes($_FILES['image']['tmp_name']); // Storing source path of the file in a variable
            $name = addslashes($_FILES['image']['name']);
            $image =file_get_contents($image);
            $image = base64_encode($image);
            saveImage($name,$image);
          }
        }
        displayImages();
        //php script to store imgs
        function saveImage($name,$image){
          $query = new queryToDatabase();
          $conn = $query->connect();
          $qry="insert into images(name,image) values ('$name', '$image')";
          $result = mysqli_query($conn,$qry);
          if($result){
            echo "<br/>Image uploaded";
          } else {
            echo "<br/>Image not uploaded";
          }
        }

        function displayImages(){
          $query = new queryToDatabase();
          $conn = $query->connect();
          $qry="select * from images";
          $result= mysqli_query($conn,$qry);
          while($row = mysqli_fetch_assoc($result)){
              echo '<img height="300" width="300" src="data:image;base64,'.$row['image'].' "> <br/>';
          }
          mysqli_close($conn);
        }
      ?>
  </body>
</html>
