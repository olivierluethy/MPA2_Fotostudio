<?php
/**
 * Gemeinsamer Kopfbereich (Tailwind-Setup + Navigation) für alle Seiten.
 *
 * Erwartete Variablen (optional):
 *   $pageTitle  -> Titel im <title>
 *   $activeNav  -> aktive Navigation ('startseite' | 'benutzerverwaltung')
 *
 * Dark-Only: Es gibt bewusst keinen Light-Mode und keinen Theme-Toggle.
 */
$pageTitle = $pageTitle ?? 'Fotostudio';
$activeNav = $activeNav ?? '';
$istEingeloggt = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$rolle = $_SESSION['role'] ?? null;
?>
<!DOCTYPE html>
<html lang="de" class="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <!-- Schriften: Serif für Museums-Anmutung, Sans für UI -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind via Play CDN (kein Build-Schritt nötig) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        wall:    '#0b0b0d', /* Galerie-Wand (fast schwarz) */
                        panel:   '#141417', /* Karten/Flächen */
                        placard: '#1b1b1f', /* Museums-Schild */
                        line:    '#2a2a30', /* dezente Linien */
                        frame:   '#e9e3d2', /* Elfenbein-Rahmen */
                        mat:      '#f6f3ea', /* Passe-partout */
                        gold:     '#c9a86a', /* vergoldeter Akzent */
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans:  ['Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        frame: '0 25px 60px -20px rgba(0,0,0,0.85)',
                    },
                },
            },
        }
    </script>

    <!--
      Reines CSS nur dort, wo Tailwind-Utilities es nicht ausdrücken können:
      - eigener Scrollbar-Look (kein Utility dafür)
      - .warning: wird von der bestehenden Validierungs-JS dynamisch als
        <label class="warning"> eingefügt; bis die JS migriert ist, hier gestylt.
    -->
    <style>
        body { -webkit-font-smoothing: antialiased; }
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: #0b0b0d; }
        ::-webkit-scrollbar-thumb { background: #2a2a30; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #3a3a42; }
        .warning { display: inline-block; margin-top: .35rem; color: #fca5a5; font-size: .8rem; }
    </style>

    <!-- Modal-/Bild-Logik global (null-sicher, läuft nur wo die Elemente existieren) -->
    <script src="public/js/bilder.js" defer></script>
</head>

<body class="min-h-screen bg-wall font-sans text-neutral-200 antialiased">

    <!-- Navigationsleiste -->
    <nav class="sticky top-0 z-40 border-b border-line bg-wall/90 backdrop-blur supports-[backdrop-filter]:bg-wall/70">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <button type="button" onclick="startseite()"
                class="group flex items-center gap-3 rounded-lg px-1 py-1 text-left transition hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                <img src="assets/icon.png" alt="" class="h-9 w-9 rounded-md object-cover ring-1 ring-gold/40">
                <span class="font-serif text-2xl font-semibold tracking-wide text-frame">Fotostudio</span>
            </button>

            <div class="flex flex-wrap items-center gap-2">
                <a href="startseite"
                   class="rounded-lg px-3 py-2 text-sm font-medium transition hover:bg-panel hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 <?= $activeNav === 'startseite' ? 'bg-panel text-white' : 'text-neutral-300' ?>">
                    Startseite
                </a>

                <?php if (!$istEingeloggt): ?>
                    <button type="button" onclick="zuLogin()"
                        class="inline-flex items-center gap-2 rounded-lg bg-gold/90 px-3 py-2 text-sm font-semibold text-wall transition hover:bg-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Einloggen
                    </button>
                <?php else: ?>
                    <?php if ($rolle == 1): ?>
                        <a href="benutzerverwaltung"
                           class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition hover:bg-panel hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60 <?= $activeNav === 'benutzerverwaltung' ? 'bg-panel text-white' : 'text-neutral-300' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Benutzer verwalten
                        </a>
                    <?php endif; ?>
                    <?php if ($rolle == 1 || $rolle == 2): ?>
                        <button type="button" onclick="openUploadModal()"
                            class="inline-flex items-center gap-2 rounded-lg bg-gold/90 px-3 py-2 text-sm font-semibold text-wall transition hover:bg-gold focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/><line x1="12" y1="7" x2="12" y2="13"/><line x1="9" y1="10" x2="15" y2="10"/></svg>
                            Bild hochladen
                        </button>
                        <button type="button" onclick="zuLogout()"
                            class="inline-flex items-center gap-2 rounded-lg border border-line px-3 py-2 text-sm font-medium text-neutral-300 transition hover:bg-panel hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Ausloggen
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </nav>
