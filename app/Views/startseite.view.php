<?php
/* Sichtbare Bilder bestimmen: nicht eingeloggt -> nur öffentliche,
   eingeloggt -> alle. Die Variablen kommen aus dem BilderController. */
$istEingeloggt = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$rolle   = $_SESSION['role'] ?? null;
$meineId = $_SESSION['id'] ?? null;
$bilder  = $istEingeloggt ? ($picAll ?? []) : ($picOpen ?? []);
?>

<?php $pageTitle = 'Startseite'; $activeNav = 'startseite'; include('app/Views/partials/head.view.php'); ?>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6">
        <header class="mb-10 text-center">
            <h1 class="font-serif text-4xl font-semibold tracking-wide text-frame">
                <?= $istEingeloggt ? 'Galerie' : 'Öffentliche Bilder' ?>
            </h1>
            <p class="mx-auto mt-2 h-px w-24 bg-gradient-to-r from-transparent via-gold to-transparent"></p>
        </header>

        <?php if (count($bilder) > 0): ?>
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 xl:grid-cols-3">
                <?php foreach ($bilder as $bild): ?>
                    <?php
                        $canEdit = $istEingeloggt && ($rolle == 1 || ($rolle == 2 && ($bild['fk_benutzerId'] ?? null) == $meineId));
                        $imgSrc  = 'data:' . $bild['imageType'] . ';base64,' . base64_encode($bild['imageData']);
                    ?>
                    <figure class="group relative">
                        <!-- Bilderrahmen: vergoldeter Rahmen + Passe-partout -->
                        <div class="rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-3 shadow-frame ring-1 ring-black/40">
                            <div class="bg-mat p-4 ring-2 ring-gold/30">
                                <div class="relative overflow-hidden bg-black">
                                    <img src="<?= $imgSrc ?>" alt="<?= e($bild['titel']) ?>"
                                         class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-[1.03]">

                                    <!-- Hover-Overlay mit Details -->
                                    <figcaption class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/90 via-black/40 to-transparent p-4 opacity-0 transition duration-300 group-hover:opacity-100">
                                        <h3 class="font-serif text-lg font-semibold text-frame"><?= e($bild['titel']) ?></h3>
                                        <p class="mt-1 line-clamp-3 text-sm text-neutral-200"><?= e($bild['beschreibung']) ?></p>
                                        <dl class="mt-3 grid grid-cols-2 gap-x-3 gap-y-1 text-xs text-neutral-300">
                                            <dt class="text-neutral-400">Datum</dt><dd><?= e($bild['datum']) ?></dd>
                                            <dt class="text-neutral-400">Ort</dt><dd><?= e($bild['ort']) ?></dd>
                                            <dt class="text-neutral-400">Von</dt><dd><?= e($bild['username']) ?></dd>
                                        </dl>
                                        <?php if ($canEdit): ?>
                                            <div class="mt-3 flex gap-2">
                                                <button type="button" onclick="bild_bearbeiten(<?= $bild['imageId'] ?>)" title="Bild bearbeiten"
                                                        class="rounded-lg bg-gold/90 px-3 py-1.5 text-xs font-semibold text-wall transition hover:bg-gold">Bearbeiten</button>
                                                <button type="button" onclick="bild_loeschen(<?= $bild['imageId'] ?>)" title="Bild löschen"
                                                        class="rounded-lg border border-red-500/50 bg-red-950/60 px-3 py-1.5 text-xs font-semibold text-red-200 transition hover:bg-red-900/70">Löschen</button>
                                            </div>
                                        <?php endif; ?>
                                    </figcaption>
                                </div>
                            </div>
                        </div>
                    </figure>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="py-20 text-center font-serif text-2xl text-neutral-500">
                <?= $istEingeloggt ? 'Keine öffentliche oder private Bilder vorhanden' : 'Keine öffentliche Bilder vorhanden' ?>
            </p>
        <?php endif; ?>
    </main>

    <?php include('app/Views/bild_hinzufuegen.view.php'); ?>
    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>
