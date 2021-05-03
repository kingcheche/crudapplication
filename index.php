<?php session_start() ?>
<?php include_once "includes/mysql-conn.php" ?>
<?php
 //Make sure only logged in users can access this page if not, send them to reg page
if(!isset($_SESSION["username"])) {
    header ("location:signup.php");
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
    <title>Dashboard</title>
</head>
<body>
   
<div class="header">
<h2 class="title" > <a href="index.php">CourseRep </a></h2> 
<form action="includes/functions.php" class="logout-btn">
    <button name="logout" class:> Logout </button>
</form>

</div>
    
<div class="container">
<div class="profile">
    <div class="pbody">
   <h1> Howdy <?php echo $_SESSION["name"]?>! </h1>
   <p class="subtext"> Username: <span> <?php echo "@" .$_SESSION["username"] ?> </span></p>
</div>

   <form action="reset.php" class="reset-btn" method="POST">
      <button name="reset" > Reset password </button>
</form>
</div>

   <p > 
       Welcome to your dashboard. In this dashboard you can manage your courses, 
       create new course, edit your course and delete them.
       What action would you like to take?
   <p>
       <hr>
 <div class="center">
<?php 
    if (isset($_GET["msg"])) {
      if ($_GET["msg"] == "coursecreated")  {
          echo "<p class='success'> New course created successfully </p>";
      } else if ($_GET["msg"] == "updatesuccess")  {
        echo "<p class='success'> Course update successfully </p>";
      } else if ($_GET["msg"] == "deletesuccess")  {
        echo "<p class='success'> Course delete successfully </p>";
      }
  }
  ?>
  </div>
</br>
 <div class="center">
<form action="create.php" class="create-btn" method="POST">
      <button name="create" > Create Course </button>
</form>
</div>

</br>
<h1 class="center"> Latest courses </h1>
</br>
<div>
    <!-- Show the latest course, from latest to oldest -->
    <?php 
    $sql = "SELECT * FROM courses ORDER BY courseid DESC LIMIT 4";
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
<form action="read.php" class="create-btn" method="POST">
      <button name="read" style="background-color:rgb(14, 74, 238);" > View all course </button>
</form>
</br>
</div> 
</body>
</html>