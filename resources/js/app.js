import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Auto-grow textarea on create/edit note pages
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".single-note .note-body").forEach((el) => {
        el.style.height = "auto";
        el.style.height = el.scrollHeight + "px";
        el.addEventListener("input", () => {
            el.style.height = "auto";
            el.style.height = el.scrollHeight + "px";
        });
    });
});