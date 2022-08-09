let currentYear = new Date().getFullYear();
document.getElementById('year').innerHTML = '&copy; ' + currentYear + ' Fotostudio. All rights Reserved.';

function home() {
    location.href = "home";
}

function goToLogin() {
    location.href = "login";
}

function goToLogOut() {
    location.href = "logout";
}

function addImage() {
    modal.style.display = "block";
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}