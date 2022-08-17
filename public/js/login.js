// Clientside Validierung - Login
window.addEventListener("load", function() {
    this.document.querySelector("form").addEventListener('submit', function(evt) {

        var errors = false;
        var warnings = document.querySelectorAll(".warning");
        if (warnings != null) {
            warnings.forEach(element => {
                element.remove();
            });
        }
        if (document.querySelector('#email') != null) {
            if (document.querySelector('#email').value.trim() === '') {
                document.querySelector('#email').insertAdjacentHTML("afterend", "<label style='color:red;'> Bitte geben Sie einen Namen ein</label>");
                errors = true;
            }
        }
        if (document.querySelector('#password') != null) {
            if (document.querySelector('#password').value.trim() === '') {
                document.querySelector('#password').insertAdjacentHTML("afterend", "<label style='color:red;'> Bitte geben Sie das Passwort ein</label>");
                errors = true;
            } else if (document.querySelector('#password').value.length < 6) {
                document.querySelector('#password').insertAdjacentHTML("afterend", "<label style='color:red;'> Passwort muss mindestens 6 Zeichen enthalten</label>");
                errors = true;
            }
        }
        if (errors) {
            evt.preventDefault();
        }
    });
});