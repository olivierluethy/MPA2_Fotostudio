# MPA_Fotostudio
Ein Projekt für die Mini PA.

## Aufgabenstellung
Ein Fotograf möchte für sein Studio und auch Privat eine WebApp, um all seine Bilder zu speichern und verwalten zu können. Auf der Webseite kann man, wenn man angemeldet ist, neue Bilder hochladen die dann gespeichert werden. Zu jedem Bild können noch folgende Informationen erfasst werden: Titel, optionale Beschreibung, Datum, Ort und ob das Bild öffentlich einsehbar sein sollte. Denn neue Einträge kann man nur erfassen, wenn man angemeldet ist. Auch sieht man nur alle Bilder in der Datenbank, wenn man angemeldet ist. Denn private Fotos sollen nicht öffentlich einsehbar sein. Wenn man nicht angemeldet ist, sieht man einfach auf der Startseite die Gallerie mit den öffentlichen Bildern. In der Applikation soll es möglich sein, alle Benutzer zu verwalten und auch welche neu hinzuzufügen. Dazu soll die ganze Webseite responsiv sein und mit allen Bildgrössen klar kommen.

## Bewertung
Bewertet wird nach dem vollen Umfang des Kriterienkatalogs Teil A und B von der PA 2022 bewertet. Zusätzlich werden wir die Code-Qualität anhand folgender dieser individuellen Kriterien bewertet:
121 - Software Ergonomie
123 - Kommentare
125 - Gliederung des Programms
164 - Fehlerbehandlung
166 - Lesbarer Code
Individuelle Kriterien sind Kriterien, die der Betrieb zusätzlich zu den schon vorhandenen, nicht verhandelbaren, Standardkriterien stellen muss. Diese sind mehr auf die Arbeit zugeschnitten, wobei die Standardkriterien mehr allgemein sind. In der PA wird es noch einen Teil C geben, der die Präsentation bewertet. Dazu werden es sieben individuelle Kriterien sein. Nachfolgend unsere Firmenvorgaben zum Codestyle:
Die Beschriftung erfolgt im üblichen Standard der verwendeten Programmiersprache. Wenn es unklar ist, werden sämtliche Variablen, Funktionen und Methoden in camelCase deklariert, ausgenommen Klassen in PascalCase.
Sämtliche Namen von Variablen, Funktionen, Methoden und Klassen sind so gewählt, dass diese auf ihren Nutzen hinweisen.
Variablen sind zuoberst bei Funktionen und Methoden deklariert.
Der Code ist sinnvoll eingerückt und nicht alles auf einer Linie. Innerhalb des Projekts sind die Einrückungszeichen überall gleich, entweder Tabs oder Spaces.

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

Kann man Margin-min oder max machen:
https://stackoverflow.com/questions/38078957/can-we-define-min-margin-and-max-margin-max-padding-and-min-padding-in-css

Um ein Wert in das Download Feld reinzutun - Kann man nicht aus Sicherheitsgründen:
https://stackoverflow.com/questions/1696877/how-to-set-a-value-to-a-file-input-in-html

Responsive Table:
https://www.w3schools.com/howto/howto_css_table_responsive.asp

Responsive Textarea:
https://stackoverflow.com/questions/39068128/how-can-i-make-a-textarea-that-fits-within-the-width-of-the-current-viewport

## Lösungen zu Problemen
Bilder die hochgeladen wurden auch anzeigen:
- Die Funktion "Bind Param" braucht kein SQL Injection und daher auch kein Backslash. Wird vom System nicht entfernt, sondern bleibt bestehen!
Bei "mysqli" braucht man sowas. Daher funktioniert es beim Beispiel im Git, aber nicht im MVC. Stöhrt aus irgendeinem Grund bei der "mysqli" Funktion nicht. Der Backslash wird irgendwie automatisch entfernt.
Dies ist aber nur eine Vermutung.
https://www.php.net/manual/de/function.addslashes.php