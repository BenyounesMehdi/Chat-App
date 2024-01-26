<?php
    session_start() ;
    // check if the user is already logged in
    if( isset($_SESSION['userUniqueId']) ) {
        header("location: user.php") ;
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
</head>
<body class="w-full bg-gray-400 flex justify-center items-center" style="min-height: 100vh;">
    
    <div class="container mx-auto bg-white w-11/12 sm:w-2/3 p-4 rounded flex gap-2 shadow-xl">
        <div id="login" class="w-full h-full">
            <p class="text-center font-bold text-3xl">Chat Me</p>
            <form action="#" autocomplete="off">
                <div id="errorField" class="mt-3 bg-[#f8d7da] rounded w-full flex justify-center items-center p-2" style="display: none;">
                    <p id="errorText" class="text-[#721c24] font-semibold text-center">This is an error message</p>
                </div>
                <div id="userInfos">
                    <input type="email" placeholder="Email" name="email" class="bg-gray-200 w-full mt-3 rounded p-2 font-semibold">
                    <div class="relative">
                        <input id="pass" type="password" oninput="showEyePassword()" name="password" placeholder="Password" class="bg-gray-200 w-full mt-3 rounded p-2 font-semibold mb-3">
                        <i id="eye" onclick="toggle()"  class="fas fa-eye absolute right-3 top-6 cursor-pointer  text-[#ccc]"></i>
                        <!-- <p id="togglePassword" onclick="toggle()" class="text-right relative -top-2 text-red-500 cursor-pointer">Show Password</p> -->
                    </div>
                    
                    <div id="submitBtn" class="flex justify-center items-center my-3 p-2 rounded bg-red-500">
                        <input type="submit" value="Start Your Chat" class="w-full cursor-pointer text-white font-semibold">
                    </div>
                    <div class="flex justify-center items-center gap-2">
                        <p class="font-semibold">Don't Have An Accout?</p>
                        <a href="register.php" class="text-red-500 font-semibold">Register Now</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="JS/toggle.js"></script>
    <script src="JS/login.js"></script>

</body>
</html>