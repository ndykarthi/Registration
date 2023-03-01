<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="Registration.css">
</head>
<body>

<form method="post" action=''>
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="iSurname"><b>SURNAME</b></label><br>
    <input type="text" placeholder="Enter Surname" name="iSurname" id="iSurname" required><br>

    <label for="iForename"><b>FORENAME</b></label><br>
    <input type="text" placeholder="Enter Forename" name="iForename" id="iForename" required><br>

    <label for="iEmail"><b>EMAIL</b></label><br>
    <input type="text" placeholder="Enter Email" name="iEmail" id="iEmail" required><br>

    <label for="iPassword"><b>PASSWORD</b></label><br>
    <input type="password" placeholder="Enter Password" name="iPassword" id="iPassword"   required><br>

    <label for="iPassword-repeat"><b>REPEAT PASSWORD</b></label><br>
    <input type="password" placeholder="Repeat Password" name="iPassword-repeat" id="iPassword-repeat" onblur="ipassValidate()" required><br>
    <hr>
    <p>By creating an account you agree to our <a href="#" id="iTerms">Terms & Privacy</a>.</p>

    <button type="submit" id="iRegister" class="iRegister">REGISTER</button>
  </div>
  <div class="container signin">
    <p>Already have an account? <a href="#" id="iSignin">Sign in</a>.</p>
  </div>
</form>
<script type="text/javascript">
function ipassValidate()
{
  let ipass= document.getElementById("iPassword");
  var irepPass = document.getElementById("iPassword-repeat");
  if(ipass.value==irepPass.value) return;
  else 
  {
    irepPass = "";
    alert("Password not matching");
  }
}
</script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reg_surname = $_POST['iSurname'];
  $reg_forename = $_POST['iForename'];
  $reg_email = $_POST['iEmail'];
  $reg_password = $_POST['iPassword'];
  $reg_passwordrepeat = $_POST['iPassword-repeat'];
  echo $reg_surname;
  echo $reg_forename;
  echo $reg_email;
  echo $reg_password;
}
?>