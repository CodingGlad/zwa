/**
 * Method used for validation of email in input.
 *
 * Changes inputs color to green if it's correct, otherwise it colors the border red.
 */
function validateEmail() {
    let email = document.querySelector("input[id=email]");
    let emailValid = document.querySelector("[id=email-valid]");
    const regex = /^[\w.]+@[a-zA-Z_.]+?\.[a-zA-Z]{2,3}$/;

    if (emailValid != null) {
        emailValid.remove();
    }

    if (email.value.match(regex)) {
        email.classList.remove("input-error");
        email.classList.add("input-correct");

        if (isRetypePresent()) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "http://habitjournal-6101.rostiapp.cz/public/signup/checkEmailAvailable/" + email.value, true);
            xhr.send();

            xhr.addEventListener("load", checkLoad);
        }
    } else {
        email.classList.add("input-error");
        email.classList.remove("input-correct");
    }

    enableButton();
}

/**
 * Method used for validation of password in sign in input.
 *
 * Changes inputs color to green if it's correct, otherwise it colors the border red.
 */
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

    enableButton();
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
    enableButton();
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

    enableButton()
}

/**
 * Method used for enabling and disabling submit button.
 *
 * Enables submit button based on the state of inputs and their classes.
 */
function enableButton() {
    let button = document.querySelector("input[type=submit]");
    let email = document.querySelector("input[id=email]")
    let passwd = document.querySelector("input[id=password]")
    let retype = document.querySelector("input[id=password_check]");

    if (retype) {
        if (email.classList.contains("input-correct") && passwd.classList.contains("input-correct") &&
            retype.classList.contains("input-correct")) {
            button.removeAttribute("disabled");
        } else {
            button.setAttribute("disabled", "");
        }
    } else {
        if (email.classList.contains("input-correct") && passwd.classList.contains("input-correct")) {
            button.removeAttribute("disabled");
        } else {
            button.setAttribute("disabled", "");
        }
    }
}

/**
 * This method listens to xmlhttprequest and displays its response into DOM. It checks whether users email is available.
 * @param event of xhr
 */
function checkLoad(event) {
    let email = document.querySelector("[id=email]");
    let emailValid = document.querySelector("[id=email-valid]");
    let response = event.target.responseText;

    if (response == "Email is available") {

        if (emailValid == null) {
            let div = document.createElement('div');
            div.setAttribute("id", "email-valid");

            div.textContent = "Email is available.";

            email.after(div);
        } else {
            emailValid.value = "Email is available.";
        }

    } else if (response == "Email has already been used") {
        email.classList.add("input-error");
        email.classList.remove("input-correct");

        if (emailValid != null) {
            emailValid.value = "Email has already been used.";
        } else {
            let div = document.createElement('div');
            div.setAttribute("id", "email-valid");

            div.textContent = "Email has already been used.";

            email.after(div);
        }
    }
    enableButton();
}

/**
 * Method that checks the existence of retype password input.
 *
 * Returns true if this element exists, otherwise false.
 */
function isRetypePresent() {
    return !!document.querySelector("input[id=password_check]");
}

document.querySelector("input[id=email]").addEventListener("blur", validateEmail);
if (isRetypePresent()) {
    document.querySelector("input[id=password]").addEventListener("blur", validatePasswordUp);
    document.querySelector("input[id=password_check]").addEventListener("blur", passwordCheck);
} else {
    document.querySelector("input[id=password]").addEventListener("blur", validatePasswordIn);
}