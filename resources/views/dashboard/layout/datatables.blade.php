@push('scripts')

    {!! Html::script('_dashboard/app-assets/vendors/js/ui/jquery.sticky.js') !!}
    {!! Html::script('datatables/datatables.min.js') !!}
    <script>
        $('.dataex-html5-selectors').DataTable({
            dom: 'Bfrtip',
            "order": [[0, "desc"]],
            responsive:true,
            buttons: [
        /*        {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },*/
               /* {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                       }
                   },*//*
                   {
                       text: 'JSON',
                       action: function ( e, dt, button, config ) {
                           var data = dt.buttons.exportData();

                           $.fn.dataTable.fileSave(
                               new Blob( [ JSON.stringify( data ) ] ),
                               'Export.json'
                           );
                       }
                   },*/
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });


    </script>
@endpush
@push('styles')
    {!! Html::style('_dashboard/app-assets/vendors/css/vendors-rtl.min.css') !!}
    {!! Html::style('datatables/datatables.min.css') !!}
@endpush
