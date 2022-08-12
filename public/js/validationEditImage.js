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
        if (document.querySelector('#titel') != null) {
            if (document.querySelector('#titel').value.trim() === '') {
                document.querySelector('#titel').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie einen Titel ein</label>");
                errors = true;
            }
        }
        if (document.querySelector('#beschreibung') != null) {
            if (document.querySelector('#beschreibung').value.trim() === '') {
                document.querySelector('#beschreibung').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie eine Beschreibung ein</label>");
                errors = true;
            }
        }
        if (document.querySelector('#datum') != null) {
            if (document.querySelector('#datum').value.trim() === '') {
                document.querySelector('#datum').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte wählen Sie ein Datum aus</label>");
                errors = true;
            }
        }
        if (document.querySelector('#ort') != null) {
            if (document.querySelector('#ort').value.trim() === '') {
                document.querySelector('#ort').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte geben Sie einen Ort ein</label>");
                errors = true;
            }
        }
        if (document.querySelector('#myFile') != null) {
            if (document.querySelector('#myFile').value.trim() === '') {
                document.querySelector('#myFile').insertAdjacentHTML("afterend", "<label class=\"warning\"> Bitte wählen Sie ein Bild aus</label>");
                errors = true;
            }
        }
        if (errors) {
            evt.preventDefault();
        }
    });
});