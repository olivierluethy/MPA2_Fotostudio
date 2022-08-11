# MPA_Fotostudio
## Verwendete Quellen
Für Rahmen:
https://freefrontend.com/css-frames/

Blur image:
https://blog.hubspot.com/website/opacity-css

Logo:
https://www.maclife.de/media/maclife/imagecache/appstore/953286746/i-eada8abc836888bb657abf9f00196a39.png

Für box-shadow:
https://getcssscan.com/css-box-shadow-examples

For shadow on text:
https://www.w3schools.com/cssref/tryit.asp?filename=trycss3_text-shadow

View for Login Page:
https://codepen.io/clln/pen/vYJWLqE

Für Tabelle in Benutzerverwaltung:
https://www.w3schools.com/css/css_table_style.asp

Für Modal:
https://www.w3schools.com/howto/howto_css_modals.asp

Für box-shadow im modal:
https://stackoverflow.com/questions/6821295/add-css-box-shadow-around-the-whole-div

Um das eingegebene Passwort zu prüfen nach dem in der Datenbank:
https://stackoverflow.com/questions/30279321/how-to-use-phps-password-hash-to-hash-and-verify-passwords

Formular für Benutzer bearbeitung:
https://codepen.io/aklima/pen/bxqXLO

## Lösungen zu Problemen
Bilder die hochgeladen wurden auch anzeigen:
- Die Funktion "Bind Param" braucht kein SQL Injection und daher auch kein Backslash. Wird vom System nicht entfernt, sondern bleibt bestehen!
Bei "mysqli" braucht man sowas. Daher funktioniert es beim Beispiel im Git, aber nicht im MVC. Stöhrt aus irgendeinem Grund bei der "mysqli" Funktion nicht. Der Backslash wird irgendwie automatisch entfernt.
Dies ist aber nur eine Vermutung.
https://www.php.net/manual/de/function.addslashes.php