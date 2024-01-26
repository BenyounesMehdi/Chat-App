<?php
    session_start() ;
    if( !isset($_SESSION['userUniqueId']) ) {
        header("location: ../index.php") ;
    }
    else {
        include"dbConnect.php" ;
        $logoutId = mysqli_real_escape_string($con, $_GET['logoutId']) ;

        if( isset($logoutId) ) {
            $userStatus = "Offline" ; // Change the status of the user
            $query = "UPDATE user SET userStatus = '{$userStatus}' WHERE uniqueUserId = '{$logoutId}'" ;

            $sql = mysqli_query($con, $query) ;

            if( $sql ) {
                session_unset() ;
                session_destroy() ;
                header("location: ../index.php") ;
            }
        }
        else {
            header("location: ../user.php") ;
        }
    }