<!-- Modal: Bild hochladen (Overlay, Museums-Anmutung, Live-Vorschau) -->
<div id="uploadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 p-4 backdrop-blur-sm">
    <div class="max-h-[92vh] w-full max-w-3xl overflow-y-auto rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-2 shadow-frame ring-1 ring-black/50">
        <div class="rounded-sm bg-panel p-6 ring-2 ring-gold/30">
            <!-- Kopf -->
            <div class="mb-5 flex items-center justify-between">
                <h2 class="font-serif text-2xl font-semibold text-frame">Bild hochladen</h2>
                <button type="button" onclick="closeUploadModal()" aria-label="Schliessen"
                        class="rounded-lg p-1.5 text-neutral-400 transition hover:bg-wall hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-gold/60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <form id="formbild_hinzufuegen" action="bild_hinzufuegen" method="POST" enctype="multipart/form-data"
                  class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <!-- Live-Vorschau im Rahmen -->
                <div>
                    <div class="rounded-sm bg-gradient-to-br from-frame to-[#cdc2a4] p-2 shadow-lg ring-1 ring-black/40">
                        <div class="bg-mat p-3 ring-2 ring-gold/30">
                            <div class="relative overflow-hidden bg-black">
                                <img id="upload_preview" src="" alt="Vorschau" class="hidden aspect-[4/3] w-full object-cover">
                                <div id="upload_noimage" class="flex aspect-[4/3] w-full flex-col items-center justify-center gap-2 bg-wall text-neutral-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                    <span class="text-xs">Noch kein Bild gewählt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="myFile" name="filename" accept="image/*" class="hidden">
                    <div class="mt-3 flex flex-wrap gap-2">
                        <button type="button" onclick="document.getElementById('myFile').click()"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-gold/90 px-3 py-2 text-xs font-semibold text-wall transition hover:bg-gold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            <span id="upload_choose_label">Bild auswählen</span>
                        </button>
                        <button type="button" id="upload_remove" onclick="removeUploadImage()"
                                class="hidden items-center gap-1.5 rounded-lg border border-red-500/50 bg-red-950/50 px-3 py-2 text-xs font-semibold text-red-200 transition hover:bg-red-900/60">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Datei entfernen
                        </button>
                    </div>
                    <p id="upload_imgError" class="mt-2 hidden text-xs text-red-300">Bitte ein Bild auswählen</p>
                </div>

                <!-- Felder -->
                <div class="space-y-4">
                    <div>
                        <label for="titel" class="mb-1 block text-sm font-medium text-neutral-300">Titel</label>
                        <input type="text" id="titel" name="titel" placeholder="Titel eingeben"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div>
                        <label for="beschreibung" class="mb-1 block text-sm font-medium text-neutral-300">Beschreibung</label>
                        <textarea id="beschreibung" name="beschreibung" rows="4" placeholder="Beschreibung eingeben"
                                  class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40"></textarea>
                    </div>
                    <div>
                        <label for="datum" class="mb-1 block text-sm font-medium text-neutral-300">Datum</label>
                        <input type="date" id="datum" name="datum"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 [color-scheme:dark] focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <div>
                        <label for="ort" class="mb-1 block text-sm font-medium text-neutral-300">Ort</label>
                        <input type="text" id="ort" name="ort" placeholder="Ort eingeben" autocomplete="off"
                               class="w-full rounded-lg border border-line bg-wall px-3 py-2 text-neutral-100 placeholder-neutral-500 focus:border-gold focus:outline-none focus:ring-2 focus:ring-gold/40">
                    </div>
                    <label class="flex items-center gap-3 text-sm font-medium text-neutral-300">
                        <input type="checkbox" id="oeffentlich" value="Yes" name="oeffentlich"
                               class="h-4 w-4 rounded border-line bg-wall text-gold focus:ring-gold/40">
                        Öffentlich
                    </label>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" onclick="closeUploadModal()"
                                class="rounded-lg border border-line px-4 py-2.5 text-sm font-medium text-neutral-300 transition hover:bg-wall hover:text-white">Abbrechen</button>
                        <button type="submit" id="upload_submit" disabled
                                class="inline-flex items-center gap-2 rounded-lg bg-gold px-4 py-2.5 text-sm font-semibold text-wall transition hover:bg-gold/90 disabled:cursor-not-allowed disabled:opacity-40">
                            Bild hochladen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
