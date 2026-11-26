<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script src="{{ asset('datatable/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            searching: true,
            searchDelay: 500,
            search: {
                smart: true,
                // Kata kunci dari kolom "Cari data anggota" di topbar (?q=...)
                search: new URLSearchParams(location.search).get('q') || '',
            },
        });
    });

    // ⌘K / Ctrl+K: fokus ke kolom cari di topbar
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            const input = document.querySelector('[data-command-search]');
            if (input && input.offsetParent) {
                e.preventDefault();
                input.focus();
            }
        }
    });
</script>
