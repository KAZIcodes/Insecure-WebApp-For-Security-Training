
function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}

function redirect($dst){
    window.location.href = $dst;
}

function passwordsMatch() {
    // Get the values of the password and confirm password fields
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    // Check if they match
    if (password === confirmPassword) {
        return true; // Passwords match
    } else {
        return false; // Passwords do not match
    }
}

