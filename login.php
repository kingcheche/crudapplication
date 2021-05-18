<?php include_once "includes/mysql-conn.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/style.css" >
    <script src="includes/js.js"></script>
    <title>User Login</title>
</head>
<body>
<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
</div>
    <div class="small-container">
    <h2> User Login </h2>
    <hr>

    <?php
    if (isset($_GET["msg"])) {
        if ($_GET["msg"] == "usercreated")  {
            echo "<p class='success'> Sign up successfull, login! </p>";
        } else if ($_GET["msg"] == "nouser") {
            echo "<p class='alert'> Incorrect email or unregistered email </p>";
        } else if ($_GET["msg"] == "wronglogin") {
            echo "<p class='alert'> Incorrect password, try again! </p>";
        }  else if ($_GET["msg"] == "logout") {
            echo "<p class='success'> You are now logged out </p>";
        } else if ($_GET["msg"] == "resetsuccess")  {
            echo "<p class='success'> Password reset successful, login with new password </p>";
        } 
    }
        ?>

        

  <form name="login" action="includes/functions.php" method="POST" class="entry">

    <input type="email" name="l-email" placeholder="Email" required> </br>

    <input type="password" name="l-password" placeholder="Password" id="pwd" required> <span class="togglepwd" id="togglepwd" onclick="myFunction()" > Show </span> </br>

    <button type="submit" name="login-submit"class="btn-btn"> Login </button>
       
  </form> 

<p class="note">Don't have an account? <a href="signup.php"> Sign up </a> </p>
</body>
</html>