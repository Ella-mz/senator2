<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5

            // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    // $(document).ready(function() {
    //     $('#example1').DataTable( {
    //         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    //     } );
    // } );
</script>
