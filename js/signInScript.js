function signInCheck(event) {
    let username = document.querySelector("[id=username]");
    let password = document.querySelector("[id=password]");

    if (username.value !== "") {
        console.log("Jmeno existuje takze chill zatim" + username.value);
    } else {
        console.log("Kokotko zapis si jmeno vole");
        event.preventDefault();
    }

    if (password.value !== "") {
        console.log("No nejake heslo tam mas takze asi dobry" + password.value);
    } else {
        console.log("More a helso jako nechces???")
        event.preventDefault();
    }

    password.value = "";
}

let form = document.querySelector("form");
form.addEventListener("submit", signInCheck);