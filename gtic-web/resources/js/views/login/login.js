import axios from "axios";

const URL = "http://127.0.0.1:8000/api/login";

//Enlace de eventos, no se puede hacer con el onclick=""
//directamente en el HTML porque la función que debe llamar está definida en otro archivo .js
document
    .getElementById("btn_login_in")
    .addEventListener("click", set_varibles_seguridad, false);

function guardarTokenAuthAPI() {
    //Si definimos estas variables con let, no podríamos utilizar a document
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    axios
        .post("/api/auth/login", {
            email: email,
            password: password
        })
        .then(
            response => {
                localStorage.setItem(
                    "token_auth_api",
                    response.data.access_token
                );
                window.location = "/home";
            },
            error => {
                console.log(error);
                alert("Revisa tu correo y contraseña");
            }
        );
}

function guardarTokenCSRF() {
    let csrf = document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content");
    localStorage.setItem("token_csrf", csrf);
}

function set_varibles_seguridad() {
    guardarTokenCSRF();
    guardarTokenAuthAPI();
}
