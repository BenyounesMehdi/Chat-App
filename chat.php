<?php
    session_start() ;
    if( !isset($_SESSION['userUniqueId']) ) {
        header("location: index.php") ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Chat Me</title>

    <style>
        #chatArea::-webkit-scrollbar {
            width: 0;
        }
        #chatArea:hover::-webkit-scrollbar {
            width: 5px;
        }
        #chatArea:hover::-webkit-scrollbar-thumb {
            background-color: gray;
            border-radius: 40px;
        }
    </style>
</head>
<body class="w-full bg-gray-400 flex justify-center items-center" style="min-height: 100vh;">
    
    <div class="container mx-auto bg-white  w-11/12 sm:w-2/3 p-1 md:p-4 rounded flex flex-col gap-2 shadow-xl">
    
        <div id="userHeader" class="flex justify-between items-center  p-2">
        <?php
            include "backend/dbConnect.php" ;  
            $user_id = mysqli_real_escape_string($con, $_GET['userId']) ;
            $query = "SELECT * FROM user WHERE uniqueUserId = '{$user_id}'" ; // Here i'm getting all the data of the current user
            $sql = mysqli_query($con, $query) ;

            if( mysqli_num_rows($sql) > 0 ) {
                $row = mysqli_fetch_assoc($sql) ;
            }
        ?>

            <div class="flex justify-center items-center gap-2">
                <div>
                    <a href="user.php"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="flex justify-center items-center gap-2">
                    <div class="flex justify-center items-center">
                        <img src="backend/uploadedimages/<?php echo $row['profileImage']?>" class="object-cover rounded-full border border-black" style="width: 4rem; height: 4rem">
                    </div>
                    <p id="username" class="font-semibold"> <?php echo $row["firstName"] . " ". $row["lastName"] ?> </p>
                </div>
            </div>
        </div>
        <hr class="border-gray-400">

        <div id="chatArea" class="flex flex-col p-2 font-semibold overflow-y-auto " style="height: 300px;">
            
        </div>

        <div id="typeArea" class="w-full flex justify-center items-center p-2">
            <form action="#" id="typingForm" class="w-full flex justify-center items-center gap-2 " autocomplete="off">
                <div class="w-11/12 relative ">
                    <input type="text" name="sendMsgId" value=" <?php echo $_SESSION['userUniqueId']; ?> " hidden>
                    <input type="text" name="receiveMsgId" value=" <?php echo $user_id ?> " hidden>
                    <input type="text" name="msg" id="TypingField" placeholder="Type Here..." class="w-full border border-black text-black  mt-3 rounded p-3 font-semibold " style="border: 1px solid black">
                </div>
                <button id="sendBtn" class=" flex justify-center items-center text-2xl relative top-1"> <i class="fa-solid fa-paper-plane"></i> </button>
            </form>
        </div>
        
    </div>

    <script src="JS/chat.js"></script>
</body>
</html>