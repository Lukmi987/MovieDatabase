
<?php

include "../main/queryToDatabase.php"; // include connection file
 // include connection file

$au = new authentication();
$query = new queryToDatabase();
$err = false;
//print_r($_GET['id']);

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


?>

<html>
<head>
    <title>Select movie</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="ajaxForGettingImg.js"></script>
<script src="ajaxToDisplayImgs.js"></script
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

      <h2>Save a new image</h2>
      <div class="main">
<h1>Ajax Image Upload</h1><br/>
<hr>
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
<div id="selectImage">
<label>Select Your Image</label><br/>
<input type="file" name="file" required /> <br />
<input type="hidden" id="mynumber" name ="file" value= <?php echo $_GET['id'] ?> />
<input type="submit" value="Upload" />
</div>
</form>
</div>
<h4 id='loading' >loading..</h4>
<div id="message"></div>

<h2>Click on a button to load 3 pictures</h2>
<button type="button" id="ButtonImgs">Load 3 pictures</button>
<div id="ImgsGallery">
</div>
</body>
</html>
