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
    <title>Update Course</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>
</div>

<?php

//Make sure, users only access this page by clicking a edit button or show an error message
if(!isset($_GET["edit"])) {
  echo "<div style='margin-top:100px'>";
  echo "<p class='alert center'> No course chosen, go to the homepage and choose a course to edit";
  echo" <form action='index.php' method='POST' class='create-btn center' >
          <button name='home'> Home </button> </form>";
          echo "</div>";
          exit();
} 
?>
<?php
//Check the id of the edit 
if(isset($_GET["edit"])){
  $courseid=$_GET["edit"];

//Get the important details to display in the edit form
  $sql = "SELECT * FROM courses WHERE courseid = $courseid;";
    if($result = mysqli_query($conn, $sql)){
      $row = mysqli_fetch_array($result);
    
                $coursename = $row["coursename"];
                $desc = $row["coursedesc"];
                $courseid = $row["courseid"];
                $creator = $row["creator"];

     // If course doesn't exist (when user try to access course by url) tell them its an invalid url
    //If i dont do this, it will load the page but show invalid variable error
 if(!isset($courseid) === TRUE) {
  header("location:index.php?msg=invalidurl");
  exit();
}              
}
}
?>

<?php
//make sure only users that created the course see the output of this course
//One could have easily bypass the view page which is the main access to this page for course creator
//by just copping the url of a  coure delete page and will be able to delete
 if($_SESSION["username"] !== $creator ){
   header("location:read.php?view=$courseid");
   exist();
 }
?>

    <div class="small-container">
    <h2> Update course </h2>
    <hr> 

    <?php 
    //Error handling
    if (isset($_GET["msg"])) {
      if ($_GET["msg"] == "stmtfailed")  {
          echo "<p class='alert'> Error Found in input, try again! </p>";
      } 
  }
  ?>

  <?php
//Used PHP to display the form so the variables gotten from the courseid row can be shown
  echo "<form name='update' action='includes/crud-functions.php' method='POST' class='entry'>
  <input type='hidden' name='update-id' value='$courseid'>
    <input type='text' name='update-coursename' placeholder='Course Name' required value='$coursename'></br>
<label for='section'> Update course section </label>
    <select class='input-select' name='update-section' placeholder='Course Section' required> 
    <option value=''>--Select--</option>
    <option value='UI/UX'>UI/UX</option>
  <option value='Frontend'>Frontend</option>
  <option value='Backend'>Backend</option>
  <option value='Mobile'>Mobile</option>

  </select> </br>

    <textarea type='textarea' rows='4' cols='10' name='update-desc' placeholder='Short description...' 
    class='descmessage' maxlength='250'required>$desc</textarea>

    <button type='submit' name='update-submit' class='btn-btn'> Update </button>
       
  </form> ";
  echo "<form name='cancel' action='read.php?view=$courseid' method='POST'>
  <button type='submit' name='cancel' class='btn-btn' style='background-color:rgb(235, 22, 65); margin-top:0px;'> Cancel </button>
</form>";

  ?>
</body>
</html>