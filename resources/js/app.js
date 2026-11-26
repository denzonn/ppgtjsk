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

// Pemilih foto di form admin (partials/photo-picker): pratinjau langsung + seret & lepas.
document.querySelectorAll('[data-photo-picker]').forEach((picker) => {
    const input = picker.querySelector('input[type=file]');
    const zone = input.closest('label');
    const show = () => {
        const file = input.files[0];
        if (!file) return;
        const grid = picker.querySelector('[data-photo-grid]');
        if (grid) {
            // Mode banyak foto: grid thumbnail (maks 8) + jumlah & total ukuran
            const files = [...input.files];
            const thumbs = files.slice(0, 8).map((f) => {
                const img = Object.assign(document.createElement('img'), { src: window.URL.createObjectURL(f), alt: '' });
                img.className = 'aspect-square w-full rounded-lg object-cover ring-1 ring-admin-border';
                return img;
            });
            if (files.length > 8) {
                const more = Object.assign(document.createElement('span'), { textContent: `+${files.length - 8}` });
                more.className = 'grid aspect-square place-items-center rounded-lg bg-admin text-xs font-semibold text-white';
                thumbs[7] = more;
            }
            grid.replaceChildren(...thumbs);
            const kb = Math.round(files.reduce((s, f) => s + f.size, 0) / 1024);
            picker.querySelector('[data-photo-name]').textContent = `${files.length} foto · ${kb} KB`;
            return;
        }
        const img = picker.querySelector('[data-photo-preview]');
        img.src = window.URL.createObjectURL(file);
        img.classList.remove('hidden');
        picker.querySelector('[data-photo-empty]')?.classList.add('hidden');
        picker.querySelector('[data-photo-name]').textContent = `${file.name} · ${Math.round(file.size / 1024)} KB`;
    };
    input.addEventListener('change', show);
    zone.addEventListener('dragover', (e) => {
        e.preventDefault();
        zone.setAttribute('data-dragover', '');
    });
    zone.addEventListener('dragleave', () => zone.removeAttribute('data-dragover'));
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.removeAttribute('data-dragover');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            show();
        }
    });
});
