const pass = document.getElementById("pass");
const eye = document.getElementById("eye");

function showEyePassword() {
    const passValue = pass.value;

    if (passValue.length > 0) {
        eye.classList.remove("text-[#ccc]");
        eye.classList.add("text-black");
    } else {
        eye.classList.remove("text-black");
        eye.classList.add("text-[#ccc]");
    }
}


function toggle() {
    if( pass.type == "password" ) {
        pass.type = "text" ;
        eye.classList.remove("fas") ;
        eye.classList.remove("fa-eye") ;
        eye.classList.add("fa-solid") ;
        eye.classList.add("fa-eye-slash") ;
    }
    else {
        pass.type = "password" ;
        eye.classList.remove("fa-solid") ;
        eye.classList.remove("fa-eye-slash") ;
        eye.classList.add("fas") ;
        eye.classList.add("fa-eye") ;
    }
}