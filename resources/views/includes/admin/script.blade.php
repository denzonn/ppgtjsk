<!-- Helpers -->
<script src="{{ asset('admin/vendor/js/helpers.js') }}"></script>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('admin/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('admin/vendor/js/menu.js') }}"></script>
<!-- endbuild -->
<!-- Main JS -->
<script src="{{ asset('admin/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('admin/js/dashboards-analytics.js') }}"></script>

<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            // Add the following options for searching
            searching: true,
            searchDelay: 500, // Delay in milliseconds before searching
            search: {
                smart: true // Enable smart search for advanced searching options
            }
        });
    });
</script>
