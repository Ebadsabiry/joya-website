function applyTranslations(lang) {
    const elements = document.querySelectorAll("[data-i18n]");

    elements.forEach(el => {
        const key = el.dataset.i18n;
        const keys = key.split(".");
        
        let value = translations[lang];
        keys.forEach(k => {
            if (value && value[k] !== undefined) {
                value = value[k];
            }
        });

        if (value !== undefined) {
            el.innerHTML = value;
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    let lang = localStorage.getItem("lang") || "en";

    applyTranslations(lang);

    // RTL switching
    if (lang === "fa" || lang === "ps") {
        document.documentElement.setAttribute("dir", "rtl");
    } else {
        document.documentElement.setAttribute("dir", "ltr");
    }

    // Function used by your language buttons
    window.changeLanguage = function(lang) {
        localStorage.setItem("lang", lang);
        applyTranslations(lang);

        if (lang === "fa" || lang === "ps") {
            document.documentElement.setAttribute("dir", "rtl");
        } else {
            document.documentElement.setAttribute("dir", "ltr");
        }
    };
});
