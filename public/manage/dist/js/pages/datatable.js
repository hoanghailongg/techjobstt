// Datatable
$("#example1").DataTable({
    "scrollX": true,
    "responsive": true, "lengthChange": false, "autoWidth": true,
    "buttons": ["copy", "csv", "excel", "pdf"],
    "columnDefs": [
        {"width": "30px", "targets": 0}
    ]
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
$('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
});

// Datatable no sort
$("#table-no-sort").DataTable({
    "bSort": false,
    "scrollX": true,
    "responsive": true, "lengthChange": false, "autoWidth": true,
    "buttons": ["copy", "csv", "excel", "pdf"],
    "columnDefs": [
        {"width": "30px", "targets": 0}
    ]
}).buttons().container().appendTo('#table-no-sort_wrapper .col-md-6:eq(0)');
