function signInCheck(event) {
    let email = document.querySelector("[id=email]");
    let password = document.querySelector("[id=password]");

    if (email.value !== "") {
        console.log("Email existuje takze chill zatim" + email.value);
    } else {
        console.log("Kokotko zapis si jmeno vole");
        email.classList.add("input-error");
        event.preventDefault();
    }

    if (password.value !== "") {
        console.log("No nejake heslo tam mas takze asi dobry" + password.value);
    } else {
        console.log("More a helso jako nechces???")
        password.classList.add("input-error");
        event.preventDefault();
    }

    password.value = "";
}

let form = document.querySelector("form");
form.addEventListener("submit", signInCheck);