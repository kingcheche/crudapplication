<?php session_start() ?>
<?php include_once "includes/mysql-conn.php" ?>
<?php
 //Make sure only logged in users can access this page if not, send them to reg page
if(!isset($_SESSION["username"])) {
    header ("location:index.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/style.css" >
    <title>Create Course</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>

</div>
    <div class="small-container">
    <h2> Create Course </h2>
    <hr>
<!-- Error handling -->
    <?php 
    if (isset($_GET["msg"])) {
      if ($_GET["msg"] == "stmtfailed")  {
          echo "<p class='alert'> Error Found in input, try again! </p>";
      } 
  }
  ?>

  <form name="create" action="includes/crud-functions.php" method="POST" class="entry">

    <input type="text" name="coursename" placeholder="Course Name" required></br>
<label for="section"> Select course section </label>
    <select class="input-select" name="section" placeholder="Course Section" required> 
    <option value=''>--Select--</option>
    <option value="UI/UX">UI/UX</option>
  <option value="Frontend">Frontend</option>
  <option value="Backend">Backend</option>
  <option value="Mobile">Mobile</option>

  </select> </br>

  <textarea type='textarea' rows='4' cols='10' name='desc' placeholder='Short description...' 
    class='descmessage' maxlength='250'required></textarea>

    <button type="submit" name="create-submit" class="btn-btn"> Create </button>
       
  </form>
  </form>
  <form name="cancel" action="index.php" method="POST">
  <button type="submit" name="cancel" class="btn-btn" style="background-color:rgb(235, 22, 65); margin-top:0px;"> Cancel </button>
</form>
</body>
</html>