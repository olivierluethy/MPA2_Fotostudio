/* Aktuelle Jahreszahl im Footer anzeigen */
var yearEl = document.getElementById('year');
if (yearEl) {
    yearEl.innerHTML = '&copy; ' + new Date().getFullYear() + ' Fotostudio. All rights Reserved.';
}

/* Navigation */
function startseite() { location.href = 'startseite'; }
function zuLogin() { location.href = 'login'; }
function zuLogout() { location.href = 'logout'; }
function bild_loeschen(id) { location.href = 'bild_loeschen?id=' + id; }
function benutzer_bearbeiten(id) { location.href = 'benutzer_bearbeiten?id=' + id; }
function benutzer_loeschen(id) { location.href = 'benutzer_loeschen?id=' + id; }

/* Modal "Benutzer hinzufügen" (nur in der Benutzerverwaltung vorhanden) */
function benutzer_hinzufuegen() {
    var m = document.getElementById('benutzer_hinzufuegen');
    if (m) { m.style.display = 'flex'; }
}

document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('benutzer_hinzufuegen');
    var close = document.querySelector('.closeUser');
    if (close && modal) {
        close.onclick = function () { modal.style.display = 'none'; };
    }
    window.addEventListener('click', function (e) {
        if (modal && e.target === modal) { modal.style.display = 'none'; }
    });
});
