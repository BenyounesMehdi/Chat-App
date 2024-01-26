const loginForm = document.querySelector("#login form") ;
const startChatBtn = document.querySelector("#submitBtn input") ;
const errorField = document.getElementById("errorField") ;
const errorMessage = document.getElementById("errorText") ;

loginForm.onsubmit = (e) => {
    e.preventDefault() ; // This is for prevent the form from submit    
}

startChatBtn.addEventListener("click", function () {
    // Start using Ajax
    let request = new XMLHttpRequest() ;

    request.open("POST", "backend/log.php", true) ;
    request.onload = () => {
        if( request.readyState === 4 && request.status === 200) {
            let data = request.responseText ;
            // console.log(data) ;
            if( data == "Done" ) {
                location.href = "user.php" ;    
            }
            else {
                errorMessage.textContent = data ;
                errorField.style.display = "block";
            }
        }
    }

    let formData = new FormData(loginForm) ; // We to create an object from FromData()
    request.send(formData) ; //Here we send the data of the form to regis.php file through Ajax
}) ;