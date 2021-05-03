<?php include_once "mysql-conn.php" ?>

<?php 
//Make sure no one access this page except through this 3 method (&& is used instead of || because isset is invert(!))
if(!isset($_POST["signup-submit"]) && !isset($_POST["login-submit"]) && !isset($_POST["reset-submit"]) && !isset($_GET["logout"])) {

    header("location:../index.php");
    exit();
} else {
    
    //Function  to check if input email exist in database
    function emailExist ($conn, $email) {
        $sql = "SELECT * FROM users WHERE email = ?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../signup.php?msg=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt); 
        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt); 
    }

    //Function  to check if input username exist in database
    function usernameExist ($conn, $username) {
        $sql = "SELECT * FROM users WHERE username = ?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../signup.php?msg=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt); 
        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt); 
    }



//Function  to create new user if user details is not in database
    function create($conn, $name, $username, $email, $h_password) {
        $sql ="INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init ($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../signup.php?msg=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $h_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location:../login.php?msg=usercreated");
        exit();
    }


 //Function to check if user exist then if password is correct before loggin in users   
    function login($conn, $l_email, $l_password){
        $emailexist = emailExist ($conn, $l_email);

        if ($emailexist === false) {
            header("location:../login.php?msg=nouser");
            exit();      
        }

        $hashedpassword = $emailexist["password"];
        $checkedpassword = password_verify($l_password, $hashedpassword);

        if ($checkedpassword === false) {
            header("location:../login.php?msg=wronglogin");
            exit();   
        } else if ($checkedpassword === true) {
                session_start();
                $_SESSION["id"] = $emailexist["id"];
                $_SESSION["name"] = $emailexist["name"];
                $_SESSION["username"] = $emailexist["username"];
                $_SESSION["email"] = $emailexist["email"];
                $_SESSION["password"] = $emailexist["password"];
                header("location:../index.php");
            exit();

        }
    }


    //Function to reset user password once error handling is passed
function resetpassword($conn, $new_hashedpassword){
    $userid = $_SESSION["id"];
    $sql = "UPDATE users SET password= ? WHERE id= ?;";
     $stmt = mysqli_stmt_init ($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location:../reset.php?msg=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $new_hashedpassword, $userid );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    //if (mysqli_query($conn, $sql)) {
    header("location:../login.php?msg=resetsuccess");
            exit();
       }
}
    


// Signup form processing
if(isset($_POST["signup-submit"])) {

    $name = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $h_password = password_hash($password, PASSWORD_BCRYPT);

    //Check if input email exist
    if (emailExist ($conn, $email) !== false) {
        header("location:../signup.php?msg=emailexist");
        exit();
     }

 //Check if input username exist
     if (usernameExist ($conn, $username) !== false) {
        header("location:../signup.php?msg=usernameexist");
        exit();
     }
//create new user if user details is not in data base
   create($conn, $name, $username, $email, $h_password);
    }


 //Login form processing   
    if(isset($_POST["login-submit"])) {

        $l_email = $_POST["l-email"];
        $l_password = $_POST["l-password"];

        login($conn, $l_email, $l_password);
    
    }

// Once logout button is clicked, kill session and redirect to login page
if(isset($_GET["logout"])) {
    session_start();
    session_unset();
    session_destroy();
    header ("location:../login.php?msg=logout");
    exit();
}

//
if(isset($_POST["reset-submit"])) {
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $conf_password = $_POST["conf_password"];
    session_start();
    $old_hashedpassword = $_SESSION["password"];
    //unhash password and check if its correct
    $verifypassword = password_verify($old_password, $old_hashedpassword);
    if ($verifypassword === false) {
        header("location:../reset.php?msg=invalidold");
        exit();   
    } else if ($verifypassword === true) {
//Don't reset password if old and new password is the same - Show error
        if (($old_password === $new_password) && ($new_password === $conf_password)){
            header("location:../reset.php?msg=nochanges");
            exit(); 
        }
        
    else if ($new_password === $conf_password) {
        $new_hashedpassword = password_hash($new_password, PASSWORD_BCRYPT);
       //create new password in database if all error handling is passed
       $userid = $_SESSION["id"];
   resetpassword($conn, $new_hashedpassword, $userid);

    } else{
        header("location:../reset.php?msg=invalidnew");
        exit(); 
    }
}
}


    
?> 
