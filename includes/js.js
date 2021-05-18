// Show/hide password for signup and login page + Reset page (Old password)

function myFunction() {
    var x = document.getElementById ("pwd");
    var y = document.getElementById ("togglepwd");

    if (x.type === "password") {
        x.type = "text";
        y.innerText = "Hide";
    } else {
        x.type = "password";
        y.innerText = "Show";
    }
}

// Show/hide password for Reset page (New password)

function mySwitch() {
    var x = document.getElementById("rpwd");
    var y = document.getElementById ("togglepwd2");

    if (x.type === "password" ) {
        x.type = "text" ; 
        y.innerText = "Hide";
    } else {
        x.type = "password";
        y.innerText = "Show";
    }
}