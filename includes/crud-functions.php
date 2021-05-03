<?php include_once "mysql-conn.php" ?>

<?php 
//Make sure no one access this page except through this 3 method (&& is used instead of || because isset is invert(!))
if(!isset($_POST["create-submit"]) && !isset($_POST["delete-submit"]) && !isset($_POST["update-submit"]) && !isset($_GET["logout"])) {
    header("location:../index.php");
    exit();
} else {

//Function  to create new user if user details is not in database
function createcourse($conn, $creator, $name, $section, $desc) {
    $sql ="INSERT INTO courses (creator, coursename, coursesection, coursedesc) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init ($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../create.php?msg=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $creator, $name, $section, $desc);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../index.php?msg=coursecreated");
    exit();
}

   //Function to update user course
   function updatecourse($conn, $updatename, $updatesection, $updatedesc, $updateid)
{
    $sql = "UPDATE courses SET coursename = ?, coursesection = ?, coursedesc = ? WHERE courseid = ?;";
     $stmt = mysqli_stmt_init ($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../update.php?msg=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssss", $updatename, $updatesection, $updatedesc, $updateid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    header("location:../index.php?msg=updatesuccess");
            exit();
       }


       //Function to delete course
function deletecourse($conn, $deleteid) {
    $sql = "DELETE FROM courses WHERE courses.courseid = ?;";
    $stmt = mysqli_stmt_init ($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:../delete.php?msg=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $deleteid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../index.php?msg=deletesuccess");
    exit();
}



// course creation form processing
if(isset($_POST["create-submit"])) {
    session_start();
    $creator = $_SESSION["username"];
    $name = $_POST["coursename"];
    $section = $_POST["section"];
    $desc = $_POST["desc"];
    
//create new course 
createcourse($conn, $creator, $name, $section, $desc);
}

// course update form processing
if(isset($_POST["update-submit"])) { 
   $updateid = $_POST["update-id"];
   $updatename = $_POST["update-coursename"];
   $updatesection = $_POST["update-section"];
   $updatedesc = $_POST["update-desc"];

   //Update course
   updatecourse($conn, $updatename, $updatesection, $updatedesc, $updateid);
}

// course delete form processing
if(isset($_POST["delete-submit"])) {
    $deleteid =  $_POST["delete-id"];

    //Delete course
   deletecourse($conn, $deleteid);
}
}
