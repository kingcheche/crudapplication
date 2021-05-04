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
    <title>Delete Course</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>
</div>

<?php

//Make sure, users only access this page by clicking a delete button or show an error message
if(!isset($_GET["delete"])) {
  echo "<div style='margin-top:100px'>";
  echo "<p class='alert center'> No course chosen, go to the homepage and choose a course to delete";
  echo" <form action='index.php' method='POST' class='create-btn center' >
          <button name='home'> Home </button> </form>";
          echo "</div>";
          exit();
} 
?>
<?php
//Check the id of the edit 
if(isset($_GET["delete"])){
  $courseid=$_GET["delete"];

//Get the important details to display in the edit form
  $sql = "SELECT * FROM courses WHERE courseid = $courseid;";
    if($result = mysqli_query($conn, $sql)){
      $row = mysqli_fetch_array($result);
    
                $coursename = $row["coursename"];
                $desc = $row["coursedesc"];
                $courseid = $row["courseid"];
                $section = $row["coursesection"];

}
}
?>
    <div class="small-container">
    <h2> Delete Course </h2>
    <hr> 

  
<p class='alert'> Course deleted can never be recovered. If not sure, cancel operation.</p>

  <?php
echo "<h3 style='display:inline'> Course name:</h3> <span> $coursename </span> </br></br>";
echo "<h3 style='display:inline'> Course Section:</h3> <span class='message' style='padding:0px 5px 0px 5px'> $section</span> </br></br>";
echo "<h3 style='display:inline'> Course description:</h3> <span> $desc </span> </br>";

  echo "<form name='delete' action='includes/crud-functions.php' method='POST'>
  <input type='hidden' name='delete-id' value='$courseid'>
  <button type='submit' name='delete-submit' class='btn-btn'> Delete </button>
</form>";

  echo "<form name='cancel'  action='read.php?view=$courseid' method='POST'>
  <button type='submit' name='cancel' class='btn-btn' style='margin-top:0px; background-color:rgb(235, 22, 65)'> Cancel </button>
</form>";

  ?>
</body>
</html>