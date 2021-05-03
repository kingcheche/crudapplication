<?php if(session_status() === PHP_SESSION_NONE) session_start();?>
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
    <title>View All Course</title>
</head>
<body>

<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>
</div>
<div class="container">
</br>
<h1 class="center">All Courses </h1>
</br>
 <!-- Show all the course, from latest to oldest -->
 <?php 
    $sql = "SELECT * FROM courses ORDER BY courseid DESC";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
    
                $coursename = $row["coursename"];
                $creator = $row["creator"];
                $time = $row["timecreated"];
                $section = $row["coursesection"];
                $desc = $row["coursedesc"];
                $courseid= $row["courseid"];

              echo "<div class='course-container'>";
              echo "<div style='width:80%; float:left'>";
                echo "<h2 style='color:black';> $coursename</h2>";
                echo "<p class='subtext message' style='width:max-content; color:rgb(14, 74, 238)';> <span> Course section:$section </span>"."</br>";
                echo "<p> $desc </p>";
                echo "<p class='timestamp'> <span> Created by $creator @ $time </span> </p>";
                echo "</div>";
                
                
                //Show edit button only if the user logged in is the creator of the course
                if($_SESSION["username"] === $creator) {
                echo "<div style='width:20%; float:right'>";
                echo "<div class='profile'>";

               echo" <form action='update.php?edit=$courseid' method='POST' class='crud-btn' >
          <button name='edit' style='background-color:rgb(14, 74, 238);'> Edit </button> </form>
          <form action='delete.php?delete=$courseid' method='POST' class='crud-btn' >
          <button name='delete' style='background-color:rgb(235, 22, 65);'> Delete </button> </form>";
          echo "</div>";
          echo "</div>";
                }
          echo "</div>";
          echo "<div >";
          echo "</br>" ."<hr style='width:100%'>" ."</br>";
          echo "<div>";  
        
                
            }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "<p class='center alert'> No course available. Create a course.</p>" ."</br";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    // Close connection
    mysqli_close($conn);
    ?>

</div>

<div class="center">
<form action="index.php" class="create-btn" method="POST">
      <button name="read" style="background-color:rgb(14, 74, 238);" > Go back home </button>
</form>
</br>

</body>
</html>