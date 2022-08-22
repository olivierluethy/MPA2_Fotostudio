/* Um das aktuelle Jahreszahl erhalten, um es dann auf den Footer anzuzeigen */
let currentYear = new Date().getFullYear();
document.getElementById('year').innerHTML = '&copy; ' + currentYear + ' Fotostudio. All rights Reserved.';

/* Um zur Route zu gelangen um auf die Startseite zu gelangen */
function startseite() {
    location.href = "startseite";
}
/* Um zur Route zu gelangen um zur Loginseite zu gelangen */
function zuLogin() {
    location.href = "login";
}
/* Um zur Route zu gelangen um zum Logout zu gelangen */
function zuLogout() {
    location.href = "logout";
}
/* Um das Modal um Bild hinzuzufügen anzuzeigen */
function bild_hinzufuegen() {
    bild_hinzufuegens.style.display = "block";
}
/* Um zur Route zu gelangen für um Bild zu bearbeiten */
function bild_bearbeiten(id) {
    location.href = "bild_bearbeiten?id=" + id;
}
/* Um zur Route zu gelangen für um Bild zu löschen */
function bild_loeschen(id) {
    location.href = "bild_loeschen?id=" + id;
}
/* Um zur Route zu gelangen für um Benutzer hinzuzufügen */
function benutzer_hinzufuegen() {
    benutzer_hinzufuegens.style.display = "block";
}
/* Um zur Route zu gelangen für um Benutzer zu bearbeiten */
function benutzer_bearbeiten(id) {
    location.href = "benutzer_bearbeiten?id=" + id;
}

/* Um zur Route zu gelangen für um Benutzer zu löschen */
function benutzer_loeschen(id) {
    location.href = "benutzer_loeschen?id=" + id;
}
// Get the modal
var bild_hinzufuegens = document.getElementById("bild_hinzufuegens");
// Get the <span> element that closes the modal
var spanImages = document.querySelector(".closeImages");

// When the user clicks on <span> (x), close the modal
spanImages.onclick = function() {
    bild_hinzufuegens.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == bild_hinzufuegens) {
        bild_hinzufuegens.style.display = "none";
    }
}

// Get the modal
var benutzer_hinzufuegens = document.getElementById("benutzer_hinzufuegen");

// Get the <span> element that closes the modal
var spanUser = document.querySelector(".closeUser");

// When the user clicks on <span> (x), close the modal
spanUser.onclick = function() {
    benutzer_hinzufuegens.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == benutzer_hinzufuegens) {
        benutzer_hinzufuegens.style.display = "none";
    }
}