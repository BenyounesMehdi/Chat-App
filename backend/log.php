<?php

    session_start() ; // Starting the session
    include "dbConnect.php" ;

    $email = mysqli_real_escape_string($con, $_POST['email']) ;
    $password = mysqli_real_escape_string($con, $_POST['password']) ;

    if( empty($email) && empty($password) ) { // Check if the inputs are empty
        echo "Please, Fill All The Inputs" ;
    }
    else {
        // Check if the user is already exit in the database or not
        $query = " SELECT * FROM user WHERE email = '{$email}' AND password = '{$password}' " ;
        $sql = mysqli_query($con, $query) ;

        if( mysqli_num_rows($sql) > 0 ) { // This means that this user is exited in the database
            $row = mysqli_fetch_assoc($sql) ;

            // when the user login his status will be Online
            $userStatus = "Online" ;
            $query2 = "UPDATE user SET userStatus = '{$userStatus}' WHERE uniqueUserId = '{$row['uniqueUserId']}'" ;
            $sql2 = mysqli_query($con, $query2) ;

            if( $sql2 ) {
                $_SESSION["userUniqueId"] = $row["uniqueUserId"]; // Here i'm using session to give me the ability to use this variable in the other php files
                echo "Done" ; 
            }
        }
        else {
            echo "Email Or Password Is Incorrect" ;
        }
    }
