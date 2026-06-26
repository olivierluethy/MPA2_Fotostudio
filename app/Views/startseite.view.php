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
                    <?php $istOeffentlich = (int)($bild['oeffentlich'] ?? 1) === 1; ?>
                    <figure class="group relative flex flex-col">
                        <!-- Bilderrahmen: vergoldeter Rahmen + Passe-partout -->
                        <div class="rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-3 shadow-frame ring-1 ring-black/40">
                            <div class="bg-mat p-4 ring-2 ring-gold/30">
                                <div class="relative overflow-hidden bg-black">
                                    <img src="<?= $imgSrc ?>" alt="<?= e($bild['titel']) ?>"
                                         class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-[1.03]">

                                    <!-- Öffentlich/Privat-Indikator -->
                                    <span title="<?= $istOeffentlich ? 'Öffentlich' : 'Privat' ?>"
                                          class="absolute left-2 top-2 inline-flex items-center gap-1 rounded-full bg-black/70 px-2 py-1 text-[11px] font-medium text-neutral-100 ring-1 ring-white/15 backdrop-blur">
                                        <?php if ($istOeffentlich): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                            Öffentlich
                                        <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            Privat
                                        <?php endif; ?>
                                    </span>

                                    <!-- Hover-Overlay: vollständige Beschreibung -->
                                    <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/90 via-black/50 to-transparent p-4 opacity-0 transition duration-300 group-hover:opacity-100">
                                        <p class="text-sm leading-relaxed text-neutral-100"><?= e($bild['beschreibung']) ?></p>
                                        <?php if ($canEdit): ?>
                                            <div class="mt-3 flex gap-2">
                                                <button type="button" title="Bild bearbeiten"
                                                        onclick="openEditModal(this)"
                                                        data-id="<?= $bild['imageId'] ?>"
                                                        data-titel="<?= e($bild['titel']) ?>"
                                                        data-beschreibung="<?= e($bild['beschreibung']) ?>"
                                                        data-datum="<?= e($bild['datum']) ?>"
                                                        data-ort="<?= e($bild['ort']) ?>"
                                                        data-oeffentlich="<?= (int)$istOeffentlich ?>"
                                                        class="rounded-lg bg-gold/90 px-3 py-1.5 text-xs font-semibold text-wall transition hover:bg-gold">Bearbeiten</button>
                                                <button type="button" onclick="bild_loeschen(<?= $bild['imageId'] ?>)" title="Bild löschen"
                                                        class="rounded-lg border border-red-500/50 bg-red-950/60 px-3 py-1.5 text-xs font-semibold text-red-200 transition hover:bg-red-900/70">Löschen</button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Museums-Schild (Wandtafel) unter dem Rahmen -->
                        <figcaption class="mx-auto -mt-1 w-[88%] rounded-b-md border border-gold/30 border-t-0 bg-gradient-to-b from-placard to-panel px-4 py-3 shadow-lg">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-serif text-base font-semibold leading-tight text-gold"><?= e($bild['titel']) ?></h3>
                                <span title="<?= $istOeffentlich ? 'Öffentlich' : 'Privat' ?>" class="mt-0.5 shrink-0">
                                    <?php if ($istOeffentlich): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <p class="mt-1 text-xs italic text-neutral-400">Veröffentlicht von <?= e($bild['username']) ?></p>
                            <div class="mt-2 flex items-center justify-between text-xs text-neutral-300">
                                <span class="inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-neutral-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    <?= e($bild['datum']) ?>
                                </span>
                                <span class="inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-neutral-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <?= e($bild['ort']) ?>
                                </span>
                            </div>
                        </figcaption>
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
    <?php if ($istEingeloggt && ($rolle == 1 || $rolle == 2)): ?>
        <?php include('app/Views/bild_bearbeiten_modal.view.php'); ?>
    <?php endif; ?>
    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>
