<?php
    session_start() ;
    if( !isset($_SESSION['userUniqueId']) ) {
        header("location: index.php") ;
    }
    else {
         include"dbConnect.php" ;
         $sendMsgId = mysqli_real_escape_string($con, $_POST['sendMsgId']) ;
         $receiveMsgId = mysqli_real_escape_string($con, $_POST['receiveMsgId']) ;
         $text = "" ;

         //Here i'm getting all the messages
         $query = "SELECT * FROM message WHERE (sendMsgId = '{$sendMsgId}' AND receiveMsgId = '{$receiveMsgId}')
            OR (sendMsgId = '{$receiveMsgId}' AND receiveMsgId = '{$sendMsgId}') 
            ORDER BY msgId  ";

        $sql = mysqli_query($con, $query) ;
        
         if( mysqli_num_rows($sql) > 0 ) {
             // Looping through all the messages and get deterimne the sent msg and the received msg
             while( $row = mysqli_fetch_assoc($sql) ) {
                 if( $row['sendMsgId'] == $sendMsgId ) { // Here means this message is sent
                     $text .= ' 
                     <div id="sendMsg" class="text-white p-3 shadow-lg" style="border-radius: 18px 18px 0 18px; background-color: black; max-width: 20rem; margin-bottom: 0.5rem; margin-left: auto;"> 
                          <p style="word-wrap: break-word;">'.$row['msg'].'</p>
                     </div>
                     ' ;
                 }
                 else { // Here means this message is received
                     $text .= ' 
                     <div id="receiveMsg" class=" text-white bg-red-500 p-3 shadow-lg " style="border-radius: 18px 18px 18px 0; max-width: 20rem; margin-bottom: 0.5rem; margin-right: auto;">
                         <p style="word-wrap: break-word;">'.$row['msg'].'</p>
                     </div>
                     ' ;
                 }
             }
             echo $text ;
         }
        // echo $text ;
    }