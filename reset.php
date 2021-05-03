<?php session_start() ?>
<?php include_once "includes/mysql-conn.php" ?>
<?php
 //Make sure only logged in users can access this page if not, send them to reg page
if(!isset($_SESSION["username"])) {
    header ("location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/style.css" >
    <title>Reset Password</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>

</div>
    <div class="small-container">
    <h2> Reset Password </h2>
    <hr> 

<?php
// Show message based on the error gotten from function.php error handling
  if (isset($_GET["msg"])) {
      if ($_GET["msg"] == "invalidold")  {
          echo "<p class='alert'> Old password incorrect, try again!</p>";
      } else if ($_GET["msg"] == "invalidnew")  {
        echo "<p class='alert'> Password confirmation incorrect, try again!</p>";
    } else if ($_GET["msg"] == "stmtfailed")  {
        echo "<p class='alert'> Error Found in input, try again! </p>";
    } else if ($_GET["msg"] == "nochanges")  {
        echo "<p class='alert'> No changes made, old and new password the same </p>";
    } 
  }


?>

  <form name="reset" action="includes/functions.php" method="POST" class="entry">

    <input type="password" name="old_password" placeholder="Old Password" required maxlength="15"></br>

    <input type="password" name="new_password" placeholder="New Password" required> </br>

  
    <input type="password" name="conf_password" placeholder="Confirm Password" required> </br>

    <button type="submit" name="reset-submit" class="btn-btn"> Reset </button>
       
  </form>
  <form name="cancel" action="index.php" method="POST">
  <button type="submit" name="cancel" class="btn-btn" style="background-color:rgb(235, 22, 65); margin-top:0px;"> Cancel </button>
</form>
</body>
</html>