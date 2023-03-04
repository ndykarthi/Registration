<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loading</title>
  <link rel="stylesheet" href="Registration.css">
</head>
<style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #6878a3;
  overflow: hidden;
}
</style>
<body>
<?php
$reg_surname = $_POST['iSurname'];
$reg_forename = $_POST['iForename'];
$reg_email = $_POST['iEmail'];
$reg_password = $_POST['iPassword'];
if (!empty($reg_surname) || !empty($reg_forename) || !empty($reg_email) || !empty($reg_password) )
{
  $db_host = "localhost:8754";
  $db_username = "root";
  $db_password = "Redh@wk12";
  $db_schema = "userdetails";
  // Create connection
  $db_connect = new mysqli ($db_host, $db_username, $db_password, $db_schema);
  if (mysqli_connect_error())
  {
    die('Connection Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
  }
  else
  {
    $SELECT = "SELECT Email From registry Where Email = ? Limit 1";
    $INSERT = "INSERT Into registry (Surname , Forename , Email, Password)values(?,?,?,?)";
    //Prepare statement
    try
    {
      $db_statement = $db_connect->prepare($SELECT);
      $db_statement->bind_param("s", $reg_forename);
      $db_statement->execute();
      $db_statement->bind_result($reg_forename);
      $db_statement->store_result();
      $db_rowcount = $db_statement->num_rows;
      //checking username
      if ($db_rowcount==0) 
      {
        $db_statement->close();
        $db_statement = $db_connect->prepare($INSERT);
        $db_statement->bind_param("ssss", $reg_surname, $reg_forename, $reg_email ,$reg_password);
        $db_statement->execute();
      }
      echo "<link rel='stylesheet' href='db_SuccessPopup.css'>;
            <div class='toast active'>
              <div class='toast-content'>
              <i class='check'></i>
                <div class='message'>
                  <span class='text text-1'>Success!</span>
                  <span class='text text-2'>Successfully registered</span>
                </div>
              </div>  
              <div class='progress active'></div>
            </div>";
            header("refresh:3;url=Landing.html");
    }
    catch(mysqli_sql_exception $error)
    {
      if($error->getCode() == 1062)
      {
        echo "<link rel='stylesheet' href='db_FailPopup.css'>;
              <div class='toast active'>
                <div class='toast-content'>
                <i class='check'></i>
                  <div class='message'>
                    <span class='text text-1'>Failed!</span>
                    <span class='text text-2'>The Email is already registered</span>
                  </div>
                </div>  
                <div class='progress active'></div>
              </div>";
        header("refresh:3;url=Registration.html");
      }
    }
    $db_statement->close();
    $db_connect->close();
  }
}
else
{
  echo "Please fill in all fields";
  die();
}
?>
</body>
</html>