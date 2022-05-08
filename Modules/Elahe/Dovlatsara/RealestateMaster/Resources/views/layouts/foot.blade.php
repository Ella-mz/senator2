{{--<script src2="{{asset('files/realestateMaster/assets/js/jquery-3.2.1.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/assets/js/owl.carousel.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/assets/js/bootstrap.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/assets/js/main.js')}}"></script>--}}
<script src="{{asset('files/realestateMaster/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('files/realestateMaster/plugins/jquery/jquery.js')}}"></script>
{{--<script src2="{{asset('files/realestateMaster/plugins/jqvmap/jquery.vmap.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/jQueryUI/jquery-ui/jquery-ui.min.js')}}"></script>--}}
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<script src="{{asset('files/realestateMaster/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/chart.js/Chart.min.js')}}"></script>
{{--<script src2="{{asset('files/realestateMaster/plugins/sparklines/sparkline.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/jqvmap/jquery.vmap.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/jquery-knob/jquery.knob.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/moment/moment.min.js')}}"></script>--}}
<script src="{{asset('files/realestateMaster/plugins/daterangepicker/daterangepicker.js')}}"></script>
{{--<script src2="{{asset('files/realestateMaster/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/summernote/summernote-bs4.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/dist/js/.eslintrc.json')}}"></script>--}}
<script src="{{asset('files/realestateMaster/dist/js/adminlte.js')}}"></script>
<script src="{{asset('files/realestateMaster/dist/js/demo.js')}}"></script>
{{--<script src2="{{asset('files/realestateMaster/dist/js/js.js')}}"></script>--}}
<script src="{{asset('files/realestateMaster/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('files/realestateMaster/dist/js/pages/dashboard2.js')}}"></script>
<script src="{{asset('files/realestateMaster/dist/js/pages/dashboard3.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/datatables/jquery.dataTables.min.js')}}"></script>
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/plugins/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>--}}
{{--<script src2="{{asset('files/realestateMaster/dist/js/jquery.toast.min.js')}}"></script>--}}
<script src="{{asset('files/realestateMaster/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('files/realestateMaster/plugins/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- bootstrap color picker -->

<script src="{{asset('files/realestateMaster/plugins/colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('files/realestateMaster/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('files/realestateMaster/plugins/iCheck/icheck.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('files/realestateMaster/plugins/fastclick/fastclick.js')}}"></script>
<!-- Persian Data Picker -->
<script src="{{asset('files/realestateMaster/dist/js/persian-date.min.js')}}"></script>
<script src="{{asset('files/realestateMaster/dist/js/persian-datepicker.min.js')}}"></script>
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


<!-- data tables js -->

<script src="{{asset('/files/realestateMaster/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/export2/buttons.flash.min.js')}}"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/export2/jszip.min.js')}}"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/export2/pdfmake.js')}}"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/export2/vfs_fonts.js')}}"></script>
<script src="{{asset('/files/realestateMaster/plugins/datatables/export2/buttons.html5.min.js')}}"></script>
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
<script>
    function invitedCopy() {
        alert('o')
        /* Get the text field */
        var copyText = document.getElementById("invitedCodeCopy");

        /* Select the text field */
        copyText.select();
        // copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
</script>

@include('sweetalert::alert')

@yield('js_realestate')
