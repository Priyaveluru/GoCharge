<?php 

require_once('./dbconnect.php');
session_start(); 

 if (empty($_POST["optionsRadios"])) {
     $error = "Select one!";
   } else {
     $result = $_POST["optionRadios"];
   }
 echo $result;
?>