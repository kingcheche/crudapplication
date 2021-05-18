<?php include_once "includes/mysql-conn.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/style.css" >
    <script src="includes/js.js"></script>
    <title>User Signup</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
</div>
    <div class="small-container">
    <h2> User Signup </h2>
    <hr> 

<?php
// Show message based on the error gotten from function.php error handling
  if (isset($_GET["msg"])) {
      if ($_GET["msg"] == "stmtfailed")  {
          echo "<p class='alert'> Error Found in input, try again! </p>";
      } else if ($_GET["msg"] == "emailexist")  {
        echo "<p class='alert'> Email already in use, try a new one!</p>";
    } else if ($_GET["msg"] == "usernameexist")  {
        echo "<p class='alert'> Username already taken, try a new one! </p>";
    } 
  }


?>

  <form name="signup" action="includes/functions.php" method="POST" class="entry">
    <input type="text" name="fullname" placeholder="Fullname" required></br>

    <input type="text" name="username" placeholder="Username" required maxlength="15"></br>

    <input type="email" name="email" placeholder="Email" required> </br>

    <input type="password" name="password" placeholder="Password" id="pwd" required> 
    <span class="togglepwd" id="togglepwd" onclick="myFunction()"> Show </span> </br>


    <button type="submit" name="signup-submit" class="btn-btn"> Sign up </button>
       
  </form>

<p class="note"> Already have an account? <a href="Login.php"> Log in </a> </p>
</body>
</html>