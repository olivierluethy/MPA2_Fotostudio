// Clientside Validierung - Benutzer hinzufügen
window.addEventListener("load", function() {
    this.document.querySelector("form").addEventListener('submit', function(evt) {

        var errors = false;
        var warnings = document.querySelectorAll(".warning");
        if (warnings != null) {
            warnings.forEach(element => {
                element.remove();
            });
        }
        if (document.querySelector('#benutzername') != null) {
            if (document.querySelector('#benutzername').value.trim() === '') {
                document.querySelector('#benutzername').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie einen Benutzernamen ein!</label>");
                errors = true;
            }
        }
        if (document.querySelector('#email') != null) {
            if (document.querySelector('#email').value.trim() === '') {
                document.querySelector('#email').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie eine Email-Adresse ein!</label>");
                errors = true;
            }
        }
        if (document.querySelector('#passwort') != null) {
            if (document.querySelector('#passwort').value.trim() === '') {
                document.querySelector('#passwort').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie das Passwort ein!</label>");
                errors = true;
            } else if (document.querySelector('#passwort').value.length < 6) {
                document.querySelector('#passwort').insertAdjacentHTML("afterend", "<label class=\"warning\"> Passwort muss mindestens 6 Zeichen enthalten!</label>");
                errors = true;
            }
        }
        if (errors) {
            evt.preventDefault();
        }
    });
});