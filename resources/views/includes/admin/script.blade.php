<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

<script src="{{ asset('datatable/DataTables-1.13.4/js/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            searching: true,
            searchDelay: 500,
            search: {
                smart: true
            },
        });
    });
</script>
