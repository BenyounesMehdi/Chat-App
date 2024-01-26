const typingForm = document.getElementById("typingForm") ;
const sendBtn = document.getElementById("sendBtn") ;
const TypingField = document.getElementById("TypingField") ;
const chatArea = document.getElementById("chatArea")  ;

typingForm.onsubmit = (e) => {
    e.preventDefault() ; // This is for prevent the form from submit   
}



// Here i'm making ao request to insert the message in the database
sendBtn.addEventListener("click", function (){
    // Start using Ajax
    let request = new XMLHttpRequest() ;
    request.open("POST", "backend/chatting.php", true) ;
    request.onload = () => {
        if( request.readyState === 4 && request.status === 200) {
            TypingField.value = "" ; // reset the value of the message field
            chatArea.scrollTop = chatArea.scrollHeight ;
        }
    }
    let formData = new FormData(typingForm) ; // We need to create an object from FromData()
    request.send(formData) ; //Here we send the data of the form to chat.php file through Ajax
}) ;

chatArea.onmouseenter = function() {
    chatArea.classList.add("in") ;
}

chatArea.onmouseleave = function() {
    chatArea.classList.remove("in") ;
}

// Here i'm making the request to get the messages from the database and display them in the chat Area
setInterval( () => {
    // Start using Ajax
    let request = new XMLHttpRequest() ;
    request.open("POST", "backend/usersChats.php", true) ; // i'm using GET method bcs i need to receive data
    request.onload = () => {
        if( request.readyState === 4 && request.status === 200) {
            let data = request.responseText ;
            chatArea.innerHTML = data ;
            if( !chatArea.classList.contains("in") ) {
                chatArea.scrollTop = chatArea.scrollHeight ;
            }
        }
    }

    let formData = new FormData(typingForm) ; // We need to create an object from FromData()
    request.send(formData) ; //Here we send the data of the form to chat.php file through Ajax

}, 500 ) ; // This fucntion will execute each 500 millisecond



