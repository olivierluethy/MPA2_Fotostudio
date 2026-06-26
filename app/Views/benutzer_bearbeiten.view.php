<?php $pageTitle = 'Benutzer bearbeiten'; $activeNav = 'benutzerverwaltung'; include('app/Views/partials/head.view.php'); ?>

    <main class="mx-auto max-w-2xl px-4 py-10 sm:px-6">
        <h2 class="mb-6 font-serif text-3xl font-semibold text-frame">Benutzer bearbeiten</h2>
        <form action="benutzer_bearbeiten?id=<?= $getBenutzer[0][0] ?>" method="POST"
              class="space-y-5 rounded-2xl border border-line bg-panel p-6 shadow-frame">
            <div>
                <label for="benutzername" class="mb-1 block text-sm font-medium text-neutral-300">Benutzername:</label>
                <input type="text" id="benutzername" name="benutzername" value="<?= $getBenutzer[0][1] ?>" placeholder="Benutzernamen eingeben"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-neutral-300">Email:</label>
                <input type="email" id="email" name="email" value="<?= $getBenutzer[0][2] ?>" placeholder="Email Adresse eingeben"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <div>
                <label for="passwort" class="mb-1 block text-sm font-medium text-neutral-300">Passwort des Benutzers:</label>
                <input type="password" id="passwort" name="passwort" placeholder="Passwort eingeben"
                       class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
            </div>
            <button type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                Benutzer ändern
            </button>
        </form>
    </main>

    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBenutzerBearbeiten.js"></script>
</body>

</html>
