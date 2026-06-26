<?php $pageTitle = 'Login'; $activeNav = ''; include('app/Views/partials/head.view.php'); ?>

    <main class="mx-auto flex max-w-md flex-col items-center px-4 py-16 sm:px-6">
        <!-- Framed login card im Museums-Stil -->
        <div class="w-full rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-3 shadow-frame ring-1 ring-black/40">
            <div class="rounded-sm bg-mat p-1 ring-2 ring-gold/40">
                <div class="rounded-sm bg-panel p-8">
                    <div class="mb-6 flex flex-col items-center text-center">
                        <span class="mb-3 inline-flex h-12 w-12 items-center justify-center rounded-full bg-gold/15 text-gold ring-1 ring-gold/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <h2 class="font-serif text-2xl font-semibold text-frame">Anmelden</h2>
                        <p class="mt-1 text-sm text-neutral-400">Willkommen zurück im Fotostudio</p>
                    </div>

                    <form id="login" class="login-form space-y-4" action="login" method="POST">
                        <div>
                            <label for="email" class="mb-1 block text-sm font-medium text-neutral-300">Email</label>
                            <input id="email" name="emailuser" type="email" placeholder="Email eingeben" required
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                   value="<?= isset($_SESSION['emailDirection']) ? htmlspecialchars($_SESSION['emailDirection'], ENT_QUOTES, 'UTF-8') : '' ?>"
                                   class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                        </div>
                        <div>
                            <label for="password" class="mb-1 block text-sm font-medium text-neutral-300">Passwort</label>
                            <input id="password" name="password" type="password" placeholder="Passwort eingeben" required
                                   class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                        </div>
                        <button type="submit"
                                class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php include('app/Views/footer.view.php'); ?>

    <script src="public/js/login.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>
