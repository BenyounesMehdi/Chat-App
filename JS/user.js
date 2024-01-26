const usersList = document.getElementById("otherUsers") ;
const searchField = document.getElementById("searchField") ;
const searchBtn = document.getElementById("searchBtn") ;

searchField.onkeyup = () => {
    let searchContent = searchField.value ;

    if( searchContent != "" ) {
        searchField.classList.add("searching") ;
    }
    else {
        searchField.classList.remove("searching") ;
    }

    let request = new XMLHttpRequest() ;

    request.open("POST", "backend/search.php", true) ; 
    request.onload = () => {
        if( request.readyState === 4 && request.status === 200) {
            let data = request.responseText ;
            // console.log(data) ;
            usersList.innerHTML = data ;
        }
    }
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded") ;
    request.send("searchContent=" + searchContent) ;
} 

setInterval( () => {
    // Start using Ajax
    let request = new XMLHttpRequest() ;

    request.open("GET", "backend/users.php", true) ; // i'm using GET method bcs i need to receive data
    request.onload = () => {
        if( request.readyState === 4 && request.status === 200) {
            let data = request.responseText ;
            // console.log(data) ;
            if( !searchField.classList.contains("searching") ) { // This will execute only when the user is not searching for someone
                usersList.innerHTML = data ;
            }
        }
    }
    request.send() ;
    

}, 500 ) ; // This fucntion will execute each 500 millisecond


