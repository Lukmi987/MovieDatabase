<?php
class authentication {


public  function testInput($userInput){


//var_dump(empty($_POST[$userInput]));
if(count($_POST)) {
    if(empty(trim($_POST[$userInput])) && $userInput == 'title'){
      $titleErr= 'Title is required !!!';
      $err = TRUE;
     return $data=array($titleErr,$err);}

      elseif(empty(trim($_POST[$userInput])) AND $userInput == 'description'){
        $descriptionErr= 'Description is required !!!';
        $err = TRUE;
        return $data= array($descriptionErr,$err);
      }
      elseif(empty(trim($_POST[$userInput])) AND $userInput == 'year'){
        $yearErr= 'year is required !!!';
        $err = TRUE;
        return $data= array($yearErr,$err);
      }
      elseif(empty(trim($_POST[$userInput])) AND $userInput == 'length'){
        $lengthErr= 'length is required !!!';
        $err = TRUE;
        return $data= array($lengthErr,$err);
      }
    }
}

  public function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
    }
}

?>
