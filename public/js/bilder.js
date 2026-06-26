// Bild-Modals: Bearbeiten (Live-Vorschau, ersetzen, entfernen, Validierung)
//
// Validierungs-Regel: Ein Bild darf nie ohne Bild gespeichert werden.
//  -> gültig, wenn das bestehende Bild behalten wird ODER ein neues gewählt ist.

/* Schaltet UI je nachdem, ob ein Bild vorhanden ist. */
function _setEditImagePresent(present) {
    var submit = document.getElementById('edit_submit');
    var err = document.getElementById('edit_imgError');
    var noimg = document.getElementById('edit_noimage');
    var prev = document.getElementById('edit_preview');
    if (present) {
        submit.disabled = false;
        err.classList.add('hidden');
        noimg.classList.add('hidden');
        noimg.classList.remove('flex');
        prev.classList.remove('hidden');
    } else {
        submit.disabled = true;
        err.classList.remove('hidden');
        noimg.classList.remove('hidden');
        noimg.classList.add('flex');
        prev.classList.add('hidden');
    }
}

/* Öffnet das Bearbeiten-Modal und füllt es aus den data-Attributen des Buttons. */
function openEditModal(btn) {
    var modal = document.getElementById('editModal');
    var fig = btn.closest('figure');
    var src = fig ? fig.querySelector('img').getAttribute('src') : '';

    document.getElementById('edit_form').action = 'bild_bearbeiten?id=' + encodeURIComponent(btn.dataset.id);
    document.getElementById('edit_titel').value = btn.dataset.titel || '';
    document.getElementById('edit_beschreibung').value = btn.dataset.beschreibung || '';
    document.getElementById('edit_datum').value = btn.dataset.datum || '';
    document.getElementById('edit_ort').value = btn.dataset.ort || '';
    document.getElementById('edit_oeffentlich').checked = btn.dataset.oeffentlich === '1';

    document.getElementById('edit_preview').src = src;
    document.getElementById('edit_file').value = '';
    document.getElementById('edit_keep').value = '1'; // bestehendes Bild behalten
    _setEditImagePresent(true);

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeEditModal() {
    var modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

/* Entfernt das aktuelle Bild aus der Vorschau -> erzwingt eine neue Auswahl. */
function removeEditImage() {
    document.getElementById('edit_preview').src = '';
    document.getElementById('edit_file').value = '';
    document.getElementById('edit_keep').value = '0'; // bestehendes Bild verworfen
    _setEditImagePresent(false);
}

document.addEventListener('DOMContentLoaded', function () {
    var file = document.getElementById('edit_file');
    if (file) {
        file.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('edit_preview').src = e.target.result;
                    document.getElementById('edit_keep').value = '0'; // neues Bild ersetzt das alte
                    _setEditImagePresent(true);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    var form = document.getElementById('edit_form');
    if (form) {
        form.addEventListener('submit', function (evt) {
            var keep = document.getElementById('edit_keep').value === '1';
            var hasNew = file && file.files && file.files.length > 0;
            if (!keep && !hasNew) {
                evt.preventDefault();
                _setEditImagePresent(false);
            }
        });
    }

    // Esc-Taste und Klick auf den Hintergrund schliessen das Modal
    var modal = document.getElementById('editModal');
    if (modal) {
        modal.addEventListener('click', function (e) { if (e.target === modal) closeEditModal(); });
    }
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeEditModal(); });
});
