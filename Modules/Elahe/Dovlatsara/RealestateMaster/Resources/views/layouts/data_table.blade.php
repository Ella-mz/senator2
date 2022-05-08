<script>
    // $(function () {
    //     $("#example1").DataTable({
    //         "responsive": true, "lengthChange": false, "autoWidth": false,
    //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // });
    $(function () {
        $("#example1").DataTable({
            "ordering": false,
            "language": {
                "sSearch": "جستجو : ",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی",
                    "sEmptyTable": "موردی یافت نشد",
                }
            },
            "info": false,

            responsive: {
                details: true
            },
        });
        new $.fn.dataTable.Responsive(table, {
            details: true
        });
    });
</script>
<script>
    // $(function () {
    //     $("#example1").DataTable({
    //         "responsive": true, "lengthChange": false, "autoWidth": false,
    //         "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // });
    $(function () {
        $("#example2").DataTable({
            "ordering": false,
            "language": {
                "sSearch": "جستجو : ",
                "paginate": {
                    "next": "بعدی",
                    "previous": "قبلی",
                    "sEmptyTable": "موردی یافت نشد",
                }
            },
            "info": false,

            responsive: {
                details: true
            },
        });
        new $.fn.dataTable.Responsive(table, {
            details: true
        });
    });
</script>
