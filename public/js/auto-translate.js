// public/js/auto-translate.js
// Batch auto-translate for elements with data-auto="text"

const TRANSLATE_URL = "/auto-translate";
let currentLang = localStorage.getItem("site-lang") || "en";

// ensure CSRF meta exists
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

function applyDirection(lang) {
    if (lang === "fa" || lang === "ps") {
        document.documentElement.dir = "rtl";
        document.documentElement.lang = lang;
        document.body.style.fontFamily = "Vazirmatn, sans-serif";
    } else {
        document.documentElement.dir = "ltr";
        document.documentElement.lang = "en";
        document.body.style.fontFamily = "Inter, sans-serif";
    }
}

// call this to translate page
async function autoTranslatePage(lang) {
    currentLang = lang;
    localStorage.setItem("site-lang", lang);
    applyDirection(lang);

    // no translation needed for English: restore originals if present
    const els = Array.from(document.querySelectorAll("[data-auto='text']"));

    // ensure each element has its original text stored
    els.forEach(el => {
        if (!el.dataset.original) {
            // preserve innerText (trim) as original
            el.dataset.original = el.innerText.trim();
        }
    });

    if (lang === "en") {
        // restore original English text
        els.forEach(el => {
            if (el.dataset.original) el.innerText = el.dataset.original;
        });
        // also restore input placeholders/values
        Array.from(document.querySelectorAll("input[data-auto='text'], textarea[data-auto='text']")).forEach(el => {
            if (el.dataset.originalPlaceholder) el.setAttribute('placeholder', el.dataset.originalPlaceholder);
            if (el.dataset.original) {
                if (['button','submit','reset'].includes((el.getAttribute('type')||'').toLowerCase())) {
                    el.value = el.dataset.original;
                }
            }
        });
        return;
    }

    const texts = els.map(el => el.dataset.original);

    if (!texts.length) return;

    // POST batch
    try {
        const res = await fetch(TRANSLATE_URL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": CSRF
            },
            body: JSON.stringify({ texts: texts, target: lang })
        });

        if (!res.ok) {
            console.warn("Translate API returned status", res.status);
            return;
        }

        const json = await res.json();
        const translations = json.translations || [];

        translations.forEach((t, i) => {
            if (typeof t === 'string' && els[i]) els[i].innerText = t;
        });

        // placeholders and inputs (single pass)
        Array.from(document.querySelectorAll("input[data-auto='text'], textarea[data-auto='text']")).forEach(async el => {
            const ph = el.getAttribute('placeholder') || '';
            if (ph) {
                if (!el.dataset.originalPlaceholder) el.dataset.originalPlaceholder = ph;
                // translate each placeholder individually (use API single-item fallback)
                try {
                    const r = await fetch(TRANSLATE_URL, {
                        method: "POST",
                        headers: { "Content-Type":"application/json", "X-CSRF-TOKEN": CSRF },
                        body: JSON.stringify({ text: el.dataset.originalPlaceholder, target: lang })
                    });
                    if (r.ok) {
                        const j = await r.json();
                        if (j.translations && j.translations[0]) {
                            el.setAttribute('placeholder', j.translations[0]);
                        } else if (j.translated) {
                            el.setAttribute('placeholder', j.translated);
                        }
                    }
                } catch (err) { /* ignore placeholder errors */ }
            }
            const type = (el.getAttribute('type')||'').toLowerCase();
            if (['button','submit','reset'].includes(type) && el.value) {
                if (!el.dataset.original) el.dataset.original = el.value;
                try {
                    const r2 = await fetch(TRANSLATE_URL, {
                        method: "POST",
                        headers: { "Content-Type":"application/json", "X-CSRF-TOKEN": CSRF },
                        body: JSON.stringify({ text: el.dataset.original, target: lang })
                    });
                    if (r2.ok) {
                        const j2 = await r2.json();
                        if (j2.translations && j2.translations[0]) el.value = j2.translations[0];
                        else if (j2.translated) el.value = j2.translated;
                    }
                } catch (err) {}
            }
        });

    } catch (err) {
        console.error("autoTranslatePage error", err);
    }
}

// Event-driven API: listen to clicks on language buttons with data-lang
document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-lang]');
    if (!btn) return;
    const lang = btn.getAttribute('data-lang');
    if (!lang) return;
    // Update UI label if present
    const labelEl = document.getElementById('langLabel');
    if (labelEl) labelEl.innerText = (lang === 'en' ? 'EN' : (lang === 'fa' ? 'دری' : 'پښتو'));
    // dispatch existing event too
    window.dispatchEvent(new CustomEvent('site:langchange', { detail: { lang } }));
    autoTranslatePage(lang);
});

// init on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('site-lang') || 'en';
    // apply direction and leave english text if en
    applyDirection(saved);
    if (saved !== 'en') autoTranslatePage(saved);
});
