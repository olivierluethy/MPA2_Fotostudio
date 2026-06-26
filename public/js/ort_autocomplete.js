// Ort-Autocomplete (Type-ahead) via Photon (https://photon.komoot.io) – ohne API-Key.
//
// Verhalten: ab 2 Zeichen, ~300ms Debounce, dunkles Dropdown, Tastatur (↑/↓/Enter/Esc),
// die ausgewählte Ortsbezeichnung landet im Ort-Feld. Wird in Upload- und Edit-Modal genutzt.

(function () {
    var DEBOUNCE_MS = 300;
    var MIN_CHARS = 2;

    /* Baut aus den Photon-Eigenschaften eine lesbare Ortsbezeichnung. */
    function buildLabel(props) {
        var parts = [props.name];
        if (props.city && props.city !== props.name) {
            parts.push(props.city);
        } else if (props.county && props.county !== props.name) {
            parts.push(props.county);
        }
        if (props.state) parts.push(props.state);
        if (props.country) parts.push(props.country);
        return parts.filter(Boolean).join(', ');
    }

    function initOrtAutocomplete(input) {
        if (!input || input.dataset.acReady) return;
        input.dataset.acReady = '1';
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('role', 'combobox');
        input.setAttribute('aria-expanded', 'false');
        input.setAttribute('aria-autocomplete', 'list');

        var wrapper = input.parentElement;
        wrapper.style.position = 'relative';

        var list = document.createElement('ul');
        list.className = 'absolute z-[60] mt-1 hidden max-h-60 w-full overflow-y-auto rounded-lg border border-line bg-panel py-1 shadow-frame';
        list.setAttribute('role', 'listbox');
        wrapper.appendChild(list);

        var items = [];        // [{label, el}]
        var activeIndex = -1;
        var timer = null;
        var lastQuery = '';

        function close() {
            list.classList.add('hidden');
            input.setAttribute('aria-expanded', 'false');
            activeIndex = -1;
        }

        function open() {
            if (items.length) {
                list.classList.remove('hidden');
                input.setAttribute('aria-expanded', 'true');
            }
        }

        function highlight(i) {
            items.forEach(function (it, idx) {
                if (idx === i) {
                    it.el.setAttribute('aria-selected', 'true');
                    it.el.classList.add('bg-wall', 'text-white');
                    it.el.scrollIntoView({ block: 'nearest' });
                } else {
                    it.el.removeAttribute('aria-selected');
                    it.el.classList.remove('bg-wall', 'text-white');
                }
            });
            activeIndex = i;
        }

        function choose(i) {
            if (i < 0 || i >= items.length) return;
            input.value = items[i].label;
            close();
        }

        function render(features) {
            list.innerHTML = '';
            items = [];
            (features || []).forEach(function (f, idx) {
                var label = buildLabel(f.properties || {});
                if (!label) return;
                var li = document.createElement('li');
                li.className = 'flex cursor-pointer items-center gap-2 px-3 py-2 text-sm text-neutral-200 hover:bg-wall hover:text-white';
                li.setAttribute('role', 'option');
                li.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0 text-gold" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>' +
                    '<span></span>';
                li.querySelector('span').textContent = label;
                var myIndex = items.length;
                li.addEventListener('mousedown', function (e) { e.preventDefault(); choose(myIndex); });
                li.addEventListener('mouseenter', function () { highlight(myIndex); });
                list.appendChild(li);
                items.push({ label: label, el: li });
            });
            if (items.length) { open(); } else { close(); }
        }

        function search(q) {
            fetch('https://photon.komoot.io/api/?q=' + encodeURIComponent(q) + '&limit=5&lang=de')
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (q !== lastQuery) return; // veraltete Antwort verwerfen
                    render(data.features);
                })
                .catch(function () { /* Netzwerkfehler ignorieren */ });
        }

        input.addEventListener('input', function () {
            var q = input.value.trim();
            lastQuery = q;
            if (timer) clearTimeout(timer);
            if (q.length < MIN_CHARS) { close(); return; }
            timer = setTimeout(function () { search(q); }, DEBOUNCE_MS);
        });

        input.addEventListener('keydown', function (e) {
            if (list.classList.contains('hidden')) return;
            if (e.key === 'ArrowDown') { e.preventDefault(); highlight(Math.min(activeIndex + 1, items.length - 1)); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); highlight(Math.max(activeIndex - 1, 0)); }
            else if (e.key === 'Enter') { if (activeIndex >= 0) { e.preventDefault(); choose(activeIndex); } }
            else if (e.key === 'Escape') { close(); }
        });

        input.addEventListener('blur', function () { setTimeout(close, 120); });
    }

    document.addEventListener('DOMContentLoaded', function () {
        ['ort', 'edit_ort'].forEach(function (id) {
            initOrtAutocomplete(document.getElementById(id));
        });
    });
})();
