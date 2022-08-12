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
    addImages.style.display = "block";
}

function addUser() {
    addUsers.style.display = "block";
}

function deleteBenutzer(id) {
    location.href = "deleteBenutzer?id=" + id;
}

function editBenutzer(id) {
    location.href = "editBenutzer?id=" + id;
}

function editBild(id) {
    location.href = "editBild?id=" + id;
}

function deleteBild(id) {
    location.href = "deleteBild?id=" + id;
}

// Get the modal
var addImages = document.getElementById("addImages");

// Get the <span> element that closes the modal
var spanImages = document.querySelector(".closeImages");

// When the user clicks on <span> (x), close the modal
spanImages.onclick = function() {
    addImages.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == addImages) {
        addImages.style.display = "none";
    }
}

// Get the modal
var addUsers = document.getElementById("addUser");

// Get the <span> element that closes the modal
var spanUser = document.querySelector(".closeUser");

// When the user clicks on <span> (x), close the modal
spanUser.onclick = function() {
    addUsers.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == addUsers) {
        addUsers.style.display = "none";
    }
}