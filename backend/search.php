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
        session_start() ;
        include "dbConnect.php" ;
        $currentUser = $_SESSION['userUniqueId'] ;
        $searchContent = mysqli_real_escape_string($con, $_POST['searchContent']) ;
        $text = "" ;

        // Fetching for the user that we get from the searchContent variable except the current user
        $query = "SELECT * FROM user WHERE NOT uniqueUserId = '{$currentUser}'
        AND (firstName LIKE '%{$searchContent}%' OR lastName LIKE '%{$searchContent}%')" ;
        $sql = mysqli_query($con, $query);

        if( mysqli_num_rows($sql) > 0 ) { // Check if the user is found or not
            // $text .= "User is Found" ;
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
        else {
            $text .= "No Result" ;
        }

         echo $text ;