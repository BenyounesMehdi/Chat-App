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
        #otherUsers::-webkit-scrollbar {
            width: 0;
        }
        #otherUsers:hover::-webkit-scrollbar {
            width: 5px;
        }
        #otherUsers:hover::-webkit-scrollbar-thumb {
            background-color: gray;
            border-radius: 40px;
        }
    </style>
</head>
<body class="w-full bg-gray-400 flex justify-center items-center" style="min-height: 100vh;">

    <div class="container mx-auto bg-white w-11/12 sm:w-2/3 p-1 md:p-4 rounded flex flex-col gap-0 shadow-xl">
        <div id="userHeader" class="flex justify-between items-center p-2 relative">

        <?php
            include "backend/dbConnect.php" ;   
            $query = " SELECT * FROM user WHERE uniqueUserId = '{$_SESSION['userUniqueId']}' " ; // Here i'm getting all the data of the current user
            $sql = mysqli_query($con, $query) ;

            if( mysqli_num_rows($sql) > 0 ) {
                $row = mysqli_fetch_assoc($sql) ;
            }
        ?>

            <div class="flex justify-center items-center gap-2 ">
                <div class="flex justify-center items-center ">
                    <img src="backend/uploadedimages/<?php echo $row['profileImage']?>" class=" object-cover rounded-full border border-black" style="width: 4rem; height: 4rem">
                </div>
                <p id="username" class="font-semibold"> <?php echo $row["firstName"] . " ". $row["lastName"] ?> </p>
            </div>
            <!-- <a href="backend/logout.php?logoutId=<?php echo $row['uniqueUserId'] ?>" id="logout" class="font-semibold text-red-500 text-2xl"><i class="fa-solid fa-right-from-bracket"></i></a> -->
            <p id="options" class="font-bold text-2xl cursor-pointer" onclick="toggoleList()">&#8942</p>
            
        </div>
        <div class="relative -top-5">
            <div id="optionsList" class="bg-gray-500  w-fit rounded-md  p-2 float-end "style="visibility: hidden;">
                    <a href="backend/logout.php?logoutId=<?php echo $row['uniqueUserId'] ?>" id="logout" class="font-semibold text-white text-xl ">Logout</a>
            </div>
        </div>
        <div id="userSearch" class="relative -top-5">
            <div class="relative mb-0 p-2">
                <input id="searchField" type="text" placeholder="Search For Someone" class="bg-gray-200 w-full rounded p-2 font-semibold ">
                <!-- <button id="searchBtn" class="absolute top-7 right-4"><i class="fas fa-search"></i></button> -->
            </div>
        </div>
        <div id="otherUsers" class="overflow-y-auto max-h-[300px] p-2">
            
        </div>
    </div>

    <script>
        let isVisible = false ;
        function toggoleList () {
            
            if( !isVisible ) {
                optionsList.style.visibility = "visible" ;
                // console.log("visible") ;
                isVisible = true ;
            }
            else {
                optionsList.style.visibility = "hidden" ;
                // console.log("hidden") ;  
                isVisible = false ;
            }
            // console.log("visi") ;
            // options.style.visibility = "visible" ;
            
        }
    </script>
    <script src="JS/user.js"></script>
</body>
</html>