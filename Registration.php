<?php

$reg_surname = $_POST['iSurname'];
$reg_forename = $_POST['iForename'];
$reg_email = $_POST['iEmail'];
$reg_password = $_POST['iPassword'];


if (!empty($reg_surname) || !empty($reg_forename) || !empty($reg_email) || !empty($reg_password) )
{

$host = "localhost:8754";
$dbusername = "root";
$dbpassword = "Redh@wk12";
$dbname = "userdetails";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Email From registry Where Email = ? Limit 1";
  $INSERT = "INSERT Into registry (Surname , Forename , Email, Password)values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $reg_forename);
     $stmt->execute();
     $stmt->bind_result($reg_forename);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $reg_surname, $reg_forename, $reg_email ,$reg_password);
      $stmt->execute();
      echo "New record inserted sucessfully";
      header("Location: Registration.html");
      exit;
     } else {
      echo "Someone already registered using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
