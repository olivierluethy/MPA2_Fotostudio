<?php $pageTitle = 'Bild bearbeiten'; $activeNav = 'startseite'; include('app/Views/partials/head.view.php'); ?>

    <main class="mx-auto max-w-2xl px-4 py-10 sm:px-6">
        <h2 class="mb-6 font-serif text-3xl font-semibold text-frame">Bild bearbeiten</h2>
        <form action="bild_bearbeiten?id=<?= $getImage[0][0] ?>" method="POST" enctype="multipart/form-data"
              class="space-y-5 rounded-2xl border border-line bg-panel p-6 shadow-frame">
            <div>
                <label for="titel" class="mb-1 block text-sm font-medium text-neutral-300">Titel:</label>
                <input type="text" id="titel" name="titel" value="<?= $getImage[0][1] ?>" placeholder="Titel eingeben"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <div>
                <label for="beschreibung" class="mb-1 block text-sm font-medium text-neutral-300">Beschreibung:</label>
                <textarea id="beschreibung" name="beschreibung" rows="5" placeholder="Beschreibung eingeben"
                          class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40"><?= $getImage[0][2] ?></textarea>
            </div>
            <div>
                <label for="datum" class="mb-1 block text-sm font-medium text-neutral-300">Datum:</label>
                <input type="date" id="datum" name="datum" value="<?= $getImage[0][3] ?>"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 [color-scheme:dark] focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <div>
                <label for="ort" class="mb-1 block text-sm font-medium text-neutral-300">Ort:</label>
                <input type="text" id="ort" name="ort" value="<?= $getImage[0][4] ?>" placeholder="Ort eingeben"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <label class="flex items-center gap-3 text-sm font-medium text-neutral-300">
                <input type="checkbox" id="oeffentlich" name="oeffentlich" value="Yes" <?= $getImage[0][5] == 1 ? 'checked' : '' ?>
                       class="h-4 w-4 rounded border-line bg-wall text-gold focus:ring-gold/40">
                Öffentlich
            </label>
            <div>
                <label for="myFile" class="mb-1 block text-sm font-medium text-neutral-300">Bild auswählen:</label>
                <input type="file" id="myFile" name="filename"
                       class="block w-full text-sm text-neutral-300 file:mr-4 file:rounded-lg file:border-0 file:bg-gold/90 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-wall hover:file:bg-gold">
            </div>
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                Bild ändern
            </button>
        </form>
    </main>

    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBildBearbeiten.js"></script>
</body>

</html>