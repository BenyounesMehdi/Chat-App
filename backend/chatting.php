<?php
    session_start() ;
    if( !isset($_SESSION['userUniqueId']) ) {
        header("location: index.php") ;
    }
    else {
        include"dbConnect.php" ;
        $sendMsgId = mysqli_real_escape_string($con, $_POST['sendMsgId']) ;
        $receiveMsgId = mysqli_real_escape_string($con, $_POST['receiveMsgId']) ;
        $msg = mysqli_real_escape_string($con, $_POST['msg']) ;

        if( !empty($msg) ) {
            $query = "INSERT INTO message (receiveMsgId, sendMsgId, msg) 
                VALUES ('{$receiveMsgId}', '{$sendMsgId}', '{$msg}')" ;

            $sql = mysqli_query($con, $query) or die() ;
            
        }
    }