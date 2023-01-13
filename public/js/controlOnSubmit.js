function submitControlCheck(event) {
    let email = document.querySelector("[id=email]");
    let password = document.querySelector("[id=password]");
    let passwordCheck = document.querySelector("[id=password_check]");

    validateEmail();
    validatePasswordUp();

    if (email.classList.contains("input-error") ||
        password.classList.contains("input-error") ||
        passwordCheck.classList.contains("input-error")) {
        event.preventDefault();
    }
}

/**
 * Method used for validation of email in input.
 *
 * Changes inputs color to green if it's correct, otherwise it colors the border red.
 */
function validateEmail() {
    let email = document.querySelector("input[id=email]");
    const regex = /^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/;

    if (email.value.match(regex)) {
        email.classList.remove("input-error");
        email.classList.add("input-correct");
    } else {
        email.classList.add("input-error");
        email.classList.remove("input-correct");
    }
}

/**
 * Method used for validation of email in sign up input.
 *
 * Changes inputs color to green if it's correct, otherwise it colors the border red.
 */
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
}

/**
 * Method used for equality between typed and retyped password.
 *
 * Changes inputs color to green if it's correct, otherwise it colors the border red.
 */
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

document.querySelector("form").addEventListener("submit", submitControlCheck);