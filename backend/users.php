<style>
.user-status-online {
    color: green;
    font-weight: 600;
     
}

.user-status-offline {
    color: red;
    font-weight: 600;
}
</style>

<?php

session_start() ; // Starting the session
include "dbConnect.php" ;

    $currentUser = $_SESSION['userUniqueId'] ;
    $query = " SELECT * FROM user WHERE NOT uniqueUserId = '{$currentUser}' " ; // Getting all the users from the database except the current user   
    $sql = mysqli_query($con, $query);
    $text = '' ;    
    

    if( mysqli_num_rows($sql) == 1 ) { // Here means that there are no other users exepect the current user
        $text .= "No Users Are Available Right Now" ;
    }
    else if( mysqli_num_rows($sql) > 0 ) { // Here means they are other user to chat with
        while ($row = mysqli_fetch_assoc($sql)) {
            $status = $row['userStatus'];
            $class = ($status == 'Online') ? 'user-status-online' : 'user-status-offline';
            $text .= '
                <a href="chat.php?userId=' . $row['uniqueUserId'] . '" class="">
                    <div class="flex flex-col">
                        <div class="flex  justify-between p-2 items-center">
                            <div class="flex justify-center items-center gap-2">
                                <div class="flex justify-center items-center">
                                    <img class="object-cover rounded-full border border-black" style="width: 4rem; height: 4rem" src="backend/uploadedimages/' . $row['profileImage'] . '">
                                </div>
                                <div>
                                    <p id="username" class="font-semibold">' . $row['firstName'] . " " . $row['lastName'] . '</p>
                                    
                                </div>
                            </div>
                            
                            <p class="'.$class.'">'.$status.'</p>
                        </div>
                        <div class="px-4">
                            <hr class="border-gray-400">
                        </div>
                    </div>
                </a>
            ';
        }
    }
    echo $text ;