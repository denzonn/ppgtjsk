// Navbar frontend: solid saat di-scroll atau saat menu mobile dibuka.
const nav = document.querySelector('[data-navbar]');
if (nav) {
    const update = () => nav.toggleAttribute('data-solid', window.scrollY > 0 || nav.hasAttribute('data-open'));
    nav.querySelector('[data-navbar-toggle]')?.addEventListener('click', () => {
        nav.toggleAttribute('data-open');
        update();
    });
    window.addEventListener('scroll', update, { passive: true });
    update();
}

// Sidebar admin di layar kecil: buka/tutup lewat tombol burger / overlay.
document.querySelectorAll('[data-sidebar-toggle]').forEach((btn) =>
    btn.addEventListener('click', () => document.body.toggleAttribute('data-sidebar-open')),
);

// Pencarian instan di halaman admin berbentuk kartu: <input data-filter="#wadah"> menyaring anak-anak [data-item].
document.querySelectorAll('[data-filter]').forEach((input) => {
    const items = document.querySelectorAll(`${input.dataset.filter} [data-item]`);
    input.addEventListener('input', () => {
        const q = input.value.trim().toLowerCase();
        items.forEach((el) => (el.hidden = !el.textContent.toLowerCase().includes(q)));
    });
});
