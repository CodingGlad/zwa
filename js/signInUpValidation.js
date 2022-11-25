function validateEmail() {
    let email = document.querySelector("input[id=email]");
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

function validatePasswordIn() {
    let passwd = document.querySelector("input[id=password]");

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

function validatePasswordUp() {
    let passwd = document.querySelector("input[id=password]");
    let regex = /(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).*/;

    if (passwd.value.length >= 8 && passwd.value.match(regex)) {
        passwd.classList.add("input-correct");
        passwd.classList.remove("input-error");
    } else {
        passwd.classList.remove("input-correct");
        passwd.classList.add("input-error");
    }

    passwordCheck();
    enableButton(passwd);
}

function passwordCheck() {
    let passwd = document.querySelector("input[id=password]");
    let passwdCheck = document.querySelector("input[id=password_check]");
    if (passwd.value === passwdCheck.value && passwd.classList.contains("input-correct")) {
        passwdCheck.classList.add("input-correct");
        passwdCheck.classList.remove("input-error");
    } else {
        passwdCheck.classList.add("input-error");
        passwdCheck.classList.remove("input-correct");
    }
}

function enableButton(element1) {
    let button = document.querySelector("input[type=submit]");
    let element2;

    if (element1.id === "password") {
        element2 = document.querySelector("input[id=email]");
    } else {
        element2 = document.querySelector("input[id=password]");
    }

    if (element1.classList.contains("input-correct") && element2.classList.contains("input-correct")) {
        button.removeAttribute("disabled");
    } else {
        button.setAttribute("disabled", "");
    }
}

document.querySelector("input[id=email]").addEventListener("blur", validateEmail);

if (document.querySelector("input[id=password_check]")) {
    document.querySelector("input[id=password]").addEventListener("blur", validatePasswordUp);
    document.querySelector("input[id=password_check]").addEventListener("blur", passwordCheck);
} else {
    document.querySelector("input[id=password]").addEventListener("blur", validatePasswordIn);
}