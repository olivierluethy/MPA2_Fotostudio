<!-- Modal -->
<div id="bild_hinzufuegens" class="bild_hinzufuegens">
    <div class="modal-content">
        <div class="modal-header">
            <span class="closeImages">&times;</span>
            <h2>Bild hochladen</h2>
        </div><br>
        <div class="modal-body">
            <form id="formbild_hinzufuegen" action="bild_hinzufuegen" method="POST" enctype="multipart/form-data">
                <label for="titel">Titel:</label><br>
                <input type="text" id="titel" name="titel" placeholder="Titel eingeben"><br><br>
                <label for="beschreibung">Beschreibung:</label><br>
                <textarea name="beschreibung" id="beschreibung" cols="30" rows="10" placeholder="Beschreibung eingeben"></textarea><br><br>
                <label for="datum">Datum:</label><br>
                <input type="date" id="datum" name="datum" placeholder="Datum eingeben"><br><br>
                <label for="ort">Ort:</label><br>
                <input type="text" id="ort" name="ort" placeholder="Ort eingeben"><br><br>
                <label for="oeffentlich">Öffentlich:</label><br>
                <input type="checkbox" id="oeffentlich" value="Yes" name="oeffentlich"><br><br>
                <label for="file">Bild auswählen:</label><br>
                <input type="file" id="myFile" name="filename"><br><br>
                <input type="submit" value="Bild hochladen">
            </form>
        </div>
    </div>
</div>