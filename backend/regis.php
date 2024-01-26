<?php
    session_start() ; // Starting the session
    include "dbConnect.php" ;

    $firstName = mysqli_real_escape_string($con, $_POST['firstName']) ;
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']) ;
    $email = mysqli_real_escape_string($con, $_POST['email']) ;
    $password = mysqli_real_escape_string($con, $_POST['password']) ;

    // Check if the inputs are empty
    if( empty($firstName) && empty($lastName) && empty($email) && empty($password) ) {
        echo "Please, Fill All The Inputs" ;
    }
    else {
        // Check if the email is valid
        if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            echo $email . " This Email Is Not A Valid Email" ;
        }
        else {
            // Check if the email is already in the database or not
            $query = "SELECT email FROM user WHERE email = '{$email}'" ;
            $sql = mysqli_query($con, $query) ;

            if( mysqli_num_rows($sql) > 0 ) { //That means the email is exit in the database
                echo $email . " This Email Is Already Exit" ;
            }
            else {
                // Check if the user has uploaded the image profile or not
                if( !isset($_FILES['profileImage']) ) {
                    echo "Please, Upload An Image" ;
                }
                else { //$_FILES returns an array
                    $imageName = $_FILES['profileImage']['name'] ; // Here i'm getting the image name
                    $imageType = $_FILES['profileImage']['type'] ; // Here i'm getting the image type
                    $tmp = $_FILES['profileImage']['tmp_name'] ; // Here i'm using this variable to save the image in the folder
                    $imageExplode = explode('.', $imageName) ;
                    $imageExtension = end($imageExplode) ; // Here i'm getting the image extension

                    $validExtension = ['jpeg', 'jpg', 'png'] ; // These are the valid image extensions

                    if( !in_array($imageExtension, $validExtension) ) { // Here i'm checking if the uploaded image is valid or not
                        echo "Please, Upload An Image" ;
                    }
                    else {
                        $time = time() ; // this will retrun the current time
                        
                        $newImageName = $time.$imageName ; // Here i'm giving the uploaded image a new name
                         // Here i'm savig the uplded image in uploadedimages folder
                        if( move_uploaded_file($tmp, "uploadedimages/".$newImageName) ) { // if The process executed successfully
                            $userStatus = "Online" ; // Here when the user register, his status will be 'online'
                            $userUniqueId = rand(time(), 1000000) ; // Here i'm creating a unique if for the user

                            // Time to insert all user infos in our database
                            $query2 = "INSERT INTO user (uniqueUserId, firstName, lastName, email, password, profileImage, userStatus)
                                VALUES ( {$userUniqueId}, '{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$newImageName}', '{$userStatus}' )" ;
                             
                             $sql2 = mysqli_query($con, $query2) ;

                             if( !$sql2 ) { // if the insertion process failed
                                echo "Error Occurred" ;
                             }
                             else {
                                $query3 = " SELECT * FROM user WHERE email = '{$email}' " ;
                                $sql3 = mysqli_query($con, $query3) ;
                                if( mysqli_num_rows($sql3) > 0 ) {
                                    $row = mysqli_fetch_assoc($sql3) ;
                                    $_SESSION["userUniqueId"] = $row["uniqueUserId"]; // Here i'm using session to give me the ability to use this variable in the other php files
                                    echo "Done" ; 
                                }
                             }

                        }
                         

                    }
                }
            }
        }
    }