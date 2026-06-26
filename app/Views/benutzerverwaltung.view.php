<?php
/* Nur der Owner (Rolle 1) darf die Benutzerverwaltung sehen. */
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || ($_SESSION['role'] ?? null) != 1) {
    header('Location: startseite');
    exit;
}
?>

<?php $pageTitle = 'Benutzerverwaltung'; $activeNav = 'benutzerverwaltung'; include('app/Views/partials/head.view.php'); ?>

    <main class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h1 class="font-serif text-3xl font-semibold text-frame">Benutzerverwaltung</h1>
            <button type="button" onclick="benutzer_hinzufuegen()"
                    class="inline-flex items-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Benutzer hinzufügen
            </button>
        </div>

        <?php if (count($benutzer) > 0): ?>
            <div class="overflow-x-auto rounded-2xl border border-line bg-panel shadow-frame">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-line text-xs uppercase tracking-wide text-neutral-400">
                        <tr>
                            <th class="px-4 py-3 font-medium">ID</th>
                            <th class="px-4 py-3 font-medium">Benutzername</th>
                            <th class="px-4 py-3 font-medium">Email</th>
                            <th class="px-4 py-3 font-medium">Rolle</th>
                            <th class="px-4 py-3 text-right font-medium">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        <?php foreach ($benutzer as $benutzer2): ?>
                            <?php
                                $rolleId = (int)$benutzer2['role'];
                                if ($rolleId === 1) { $rolleText = 'Owner'; $badge = 'bg-emerald-500/15 text-emerald-300 ring-emerald-500/30'; }
                                elseif ($rolleId === 2) { $rolleText = 'VIP'; $badge = 'bg-gold/15 text-gold ring-gold/30'; }
                                else { $rolleText = 'Benutzer'; $badge = 'bg-neutral-500/15 text-neutral-300 ring-neutral-500/30'; }
                            ?>
                            <tr class="transition hover:bg-wall/60">
                                <td class="px-4 py-3 text-neutral-400"><?= e((string)$benutzer2['benutzerId']) ?></td>
                                <td class="px-4 py-3 font-medium text-neutral-100"><?= e($benutzer2['username']) ?></td>
                                <td class="px-4 py-3 text-neutral-300"><?= e($benutzer2['email']) ?></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset <?= $badge ?>"><?= $rolleText ?></span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" onclick="benutzer_bearbeiten(<?= $benutzer2['benutzerId'] ?>)" title="Benutzer bearbeiten" aria-label="Benutzer bearbeiten"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-gold/90 text-wall transition hover:bg-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                        </button>
                                        <?php if ($rolleId === 1): ?>
                                            <span title="Owner kann nicht gelöscht werden" aria-label="Owner kann nicht gelöscht werden"
                                                  class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-neutral-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                            </span>
                                        <?php else: ?>
                                            <button type="button" onclick="benutzer_loeschen(<?= $benutzer2['benutzerId'] ?>)" title="Benutzer löschen" aria-label="Benutzer löschen"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-500/50 bg-red-950/60 text-red-200 transition hover:bg-red-900/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500/60">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="py-20 text-center font-serif text-2xl text-neutral-500">Noch keine Benutzer vorhanden</p>
        <?php endif; ?>
    </main>

    <!-- Modal: Benutzer hinzufügen -->
    <div id="benutzer_hinzufuegen" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4 backdrop-blur-sm">
        <div class="w-full max-w-md rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-2 shadow-frame ring-1 ring-black/50">
            <div class="rounded-sm bg-panel p-6 ring-2 ring-gold/30">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="font-serif text-2xl font-semibold text-frame">Benutzer hinzufügen</h2>
                    <span class="closeUser cursor-pointer rounded-lg p-1.5 text-2xl leading-none text-neutral-400 transition hover:bg-wall hover:text-white">&times;</span>
                </div>
                <form id="formbenutzer_hinzufuegen" action="benutzer_hinzufuegen" method="POST" class="space-y-4">
                    <div>
                        <label for="benutzername" class="mb-1 block text-sm font-medium text-neutral-300">Benutzername</label>
                        <input type="text" id="benutzername" name="benutzername" placeholder="Benutzername eingeben"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-neutral-300">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email eingeben"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div>
                        <label for="passwort" class="mb-1 block text-sm font-medium text-neutral-300">Passwort</label>
                        <input type="password" id="passwort" name="passwort" placeholder="Passwort eingeben"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div>
                        <label for="passwort_bestaetigen" class="mb-1 block text-sm font-medium text-neutral-300">Passwort bestätigen</label>
                        <input type="password" id="passwort_bestaetigen" name="passwort_bestaetigen" placeholder="Passwort noch einmal eingeben"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                            Benutzer hinzufügen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('app/Views/bild_hinzufuegen.view.php'); ?>
    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/main.js"></script>
    <script src="public/js/validationBenutzerHinzufuegen.js"></script>
    <script src="public/js/validationBildHinzufuegen.js"></script>
</body>

</html>
