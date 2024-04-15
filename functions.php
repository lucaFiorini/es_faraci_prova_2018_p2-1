<?php

function getConn(): mysqli | false {
  try{

    $conn = mysqli_connect("localhost","root","","MySmart");
    
    if(!$conn)  {

      echo "Internal server Error";
      die(500);
    
    }

    return $conn;

  } catch (Exception $e){

    echo "Internal server Error";
    die(500);
  
  }

}
