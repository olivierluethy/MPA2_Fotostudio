let currentYear = new Date().getFullYear();
document.getElementById('year').innerHTML = '&copy; ' + currentYear + ' Constant_Framework. All rights Reserved.';

function home() {
    location.href = "";
}

function goToLogin() {
    location.href = "login";
}

function goToLogOut() {
    location.href = "logout";
}