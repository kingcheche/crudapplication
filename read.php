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
    <title>View Course</title>
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
if(!isset($_GET["view"]) && !isset($_GET["delete-submit"]) && !isset($_GET["edit-submit"]) ) {
  echo "<div style='margin-top:100px'>";
  echo "<p class='alert center'> No course chosen, go to the homepage and choose a course to view";
  echo" <form action='index.php' method='POST' class='create-btn center' >
          <button name='home' style='margin:10px;'> Home </button> </form>";
          echo "</div>";
          exit();
} 

if(!isset($_GET["view"])){
    $courseid=$_GET["view"]; {
echo "<p class=alert> This is not working";
exit();
    }
}

?>
<?php
//Check the id of the edit 
if(isset($_GET["view"])){
  $courseid=$_GET["view"];

//Get the important details to display in the edit form
  $sql = "SELECT * FROM courses WHERE courseid = $courseid;";
    if($result = mysqli_query($conn, $sql)){
      $row = mysqli_fetch_array($result);

                $coursename = $row["coursename"];
                $creator = $row["creator"];
                $time = $row["timecreated"];
                $section = $row["coursesection"];
                $desc = $row["coursedesc"];
                $courseid= $row["courseid"];

      // If course doesn't exist (when user try to access course by url) tell them its an invalid url
    //If i dont do this, it will load the page but show invalid variable error
 if(!isset($courseid) === TRUE) {
  header("location:index.php?msg=invalidurl");
  exit();
}
}
}
?>
    <div class="small-container">
    <h2> View Course </h2>
    <hr> 

  <?php

echo "<h3 style='display:inline'> Course name:</h3> <span> $coursename </span> </br></br>";
echo "<h3 style='display:inline'> Course Section:</h3> <span class='message' style='padding:0px 5px 0px 5px'> $section</span> </br></br>";
echo "<h3 style='display:inline'> Course description:</h3> <span> $desc </span> </br>";

if($_SESSION["username"] !== $creator) {
    echo "<p class='alert'> This course is view only. You can only edit a course you created</p>";
} else {
echo "<div class='profile'>";
  echo "<form name='edit' action='update.php?edit=$courseid' method='POST' class='crud-btn' style='width:50%;'>
  <button type='submit' name='edit-submit' style='background-color:rgb(14, 74, 238); width:98% ' > Edit </button>
</form>";

  echo "<form name='delete' action='delete.php?delete=$courseid' method='POST' class='crud-btn'  style='width:50%'>
  <button type='submit' name='delete'  style='background-color:rgb(235, 22, 65); width:98%'> Delete </button>
</form>";
echo "</div>";
}
  ?>

 <form name='edit' action='index.php#courses' method='POST' class='create-btn' >
  <button type='submit' name='edit-submit' style='width:100%' > Go back </button>
</form>

</body>
</html>