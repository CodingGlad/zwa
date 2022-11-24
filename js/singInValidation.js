function validateEmail() {
    let email = document.querySelector("input[type=email]");
    const regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

    if (email.value.match(regex)) {
        console.log("dik");
        email.classList.remove("input-error");
        email.classList.add("input-correct");
    } else {
        email.classList.add("input-error");
        email.classList.remove("input-correct");
    }

    enableButton(email);
}

function validatePassword() {
    let passwd = document.querySelector("input[type=password]");

    if (passwd.value.length >= 8) {
        passwd.classList.remove("input-error");
        passwd.classList.add("input-correct");
    }
    else {
        passwd.classList.add("input-error");
        passwd.classList.remove("input-correct");
    }

    enableButton(passwd);
}

function enableButton(element1) {
    let button = document.querySelector("input[type=submit]");
    let element2;

    if (element1.id === "password") {
        element2 = document.querySelector("input[type=email]");
    } else {
        element2 = document.querySelector("input[type=password]");
    }

    if (element1.classList.contains("input-correct") && element2.classList.contains("input-correct")) {
        button.removeAttribute("disabled");
    } else {
        button.setAttribute("disabled", "");
    }
}

document.querySelector("input[type=email]").addEventListener("blur", validateEmail);
document.querySelector("input[type=password]").addEventListener("blur", validatePassword);