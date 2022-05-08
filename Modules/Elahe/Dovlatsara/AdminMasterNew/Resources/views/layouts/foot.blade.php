<!-- jQuery -->
<script src="{{asset('files/adminMaster/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>--}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--<script>--}}
{{--    $.widget.bridge('uibutton', $.ui.button)--}}
{{--</script>--}}
<!-- Bootstrap 4 -->
<script src="{{asset('files/adminMaster/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Morris.js charts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>--}}
<script src="{{asset('files/adminMaster/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('files/adminMaster/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('files/adminMaster/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('files/adminMaster/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('files/adminMaster/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>--}}
<script src="{{asset('files/adminMaster/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('files/adminMaster/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('files/adminMaster/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{asset('files/adminMaster/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('files/adminMaster/plugins/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Slimscroll -->
<script src="{{asset('files/adminMaster/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('files/adminMaster/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('files/adminMaster/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{asset('files/adminMaster/dist/js/pages/dashboard.js')}}"></script>--}}
<!-- AdminLTE for demo purposes -->
<script src="{{asset('files/adminMaster/dist/js/demo.js')}}"></script>

{{--<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>--}}

<script src="{{asset('files/adminMaster/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('files/adminMaster/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>

{{--    <!-- Persian Data Picker -->--}}
<script src="{{asset('files/adminMaster/dist/js/persian-date.min.js')}}"></script>
<script src="{{asset('files/adminMaster/dist/js/persian-datepicker.min.js')}}"></script>
{{--    <!-- AdminLTE for demo purposes -->--}}

<script src="{{asset('files/adminMaster/plugins/select2/select2.full.min.js')}}"></script>

<script>
    function separateNum(value, input) {
        /* seprate number input 3 number */
        var nStr = value + '';
        nStr = nStr.replace(/\,/g, "");
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        if (input !== undefined) {

            input.value = x1 + x2;
        } else {
            return x1 + x2;
        }
    }
</script>
{{--<script>--}}
{{--    jQuery(document).ready(function () {--}}
{{--        jQuery('a[id="pushbuttonadminMaster"]').on('click', function () {--}}
{{--            if($(".sidebar-mini").hasClass('sidebar-open')){--}}
{{--                $(".sidebar-mini").removeClass('sidebar-open')--}}
{{--                $(".sidebar-mini").addClass('sidebar-collapse')--}}
{{--            }--}}
{{--            else if($(".sidebar-mini").hasClass('sidebar-collapse'))--}}
{{--            {--}}
{{--                $(".sidebar-mini").removeClass('sidebar-collapse')--}}
{{--                $(".sidebar-mini").addClass('sidebar-open')--}}
{{--            }--}}
{{--            else if(!$(".sidebar-mini").hasClass('sidebar-open'))--}}
{{--            {--}}
{{--                $(".sidebar-mini").removeClass('sidebar-collapse')--}}
{{--                $(".sidebar-mini").addClass('sidebar-open')--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

<script src="{{asset('files/adminMaster/dist/js/adminlte.js')}}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.normal-example').persianDatepicker();
    })
</script>


<script src="{{asset('/files/AdminMaster/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/export2/buttons.flash.min.js')}}"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/export2/jszip.min.js')}}"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/export2/pdfmake.js')}}"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/export2/vfs_fonts.js')}}"></script>
<script src="{{asset('/files/AdminMaster/plugins/datatables/export2/buttons.html5.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>


<script>

    $(document).ready(function() {
        $("#datatable").DataTable({

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            "ordering": false,
            "searching": false,
            "bPaginate": false,
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
            }
        });
        new $.fn.dataTable.Responsive(table, {
            details: true
        });
    });
    $(document).ready(function() {
        $("#datatable-with_pagination").DataTable({

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
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
            }
        });
        new $.fn.dataTable.Responsive(table, {
            details: true
        });
    });

</script>

@include('sweetalert::alert')

@yield('js')
