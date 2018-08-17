<?php

include ("authentication.php");


class queryToDatabase{


  public function connect(){

    $conn = mysqli_connect('localhost', 'root', '', 'movie') or die(mysqli_error($conn));
    return $conn;
  }


      public function insertFilm(){
           $au = new authentication();

           $title = $au->test_input($_POST['title']);
           $description= $au->test_input($_POST['description']);
           $release_year= $au->test_input($_POST['year']);
           $length= $au->test_input($_POST['length']);

           $insertSQL = ("INSERT INTO movies(title,description,release_year,length) VALUES('$title','$description', '$release_year', '$length')");

           $insertQuery = mysqli_query($this->connect(),$insertSQL) or die(mysqli_error($this->connect()));
           return $insertQuery;
        }

        public function updateFilm(){
          $au = new authentication();
          $filmId = $_GET['id'];
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

                       $updateQuery = mysqli_query($this->connect(),$update) or die(mysqli_error($this->connect()));

                       return $updateQuery;
        }

    public function  selectFilm(){
      $filmId = $_GET['id'];
      var_dump($filmId);
      $sql = "SELECT * FROM movies WHERE film_id='$filmId'";
      $result = mysqli_query($this->connect(), $sql) OR die(mysqli_error($this->connect()));
      return $result;
    }


    public function selectAllFilms(){
      $selectSQL = "SELECT * FROM movies"; // select all
      $selectQuery = mysqli_query($this->connect(), $selectSQL) or die(mysqli_error($this->connect())); // run sql query
        return $selectQuery;
    }

    public function verifyInsertSuccess($query){
      if($query) { // check if insertion is successful or not
          // insertion successful
        return "<h2>Record has been safed</h2>";
      } else {
          // insertion unsuccessful
        return "<h2>There are errors pls try again.</h2>";
      }
    }

    public function createArrayofFilmsandReturnJsonFile($selectQuery){
      if(mysqli_num_rows($selectQuery) != 0) { // check if there are record(s)

        $movies = array();
        while($row = mysqli_fetch_assoc($selectQuery)){
          $movies[] = $row;
        }
        //write to json file

        $fp = fopen('moviesData.json', 'w');
        fwrite($fp, json_encode($movies));
        fclose($fp);
      }
    }

}

 ?>
