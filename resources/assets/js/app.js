$(document).ready( function () {

    //set moment.js to sort dates in dataTables
    $.fn.dataTable.moment('DD-MM-YYYY HH:mm');

    //language settings
    var dutch = {
        "sProcessing": "Bezig...",
        "sLengthMenu": "_MENU_ resultaten weergeven",
        "sZeroRecords": "Geen resultaten gevonden",
        "sInfo": "_START_ tot _END_ van _TOTAL_ resultaten",
        "sInfoEmpty": "Geen resultaten om weer te geven",
        "sInfoFiltered": " (gefilterd uit _MAX_ resultaten)",
        "sInfoPostFix": "",
        "sSearch": "Zoeken:",
        "sEmptyTable": "Geen resultaten aanwezig in de tabel",
        "sInfoThousands": ".",
        "sLoadingRecords": "Een moment geduld aub - bezig met laden...",
        "oPaginate": {
            "sFirst": "Eerste",
            "sLast": "Laatste",
            "sNext": "Volgende",
            "sPrevious": "Vorige"
        },
        "oAria": {
            "sSortAscending":  ": activeer om kolom oplopend te sorteren",
            "sSortDescending": ": activeer om kolom aflopend te sorteren"
        }
    };

    $('#activity-manage-table').DataTable({
        language: dutch,
        "pageLength": 100,
        "order": []
    });

    $('#activities-entries-table').DataTable({
        language: dutch,
        "pageLength": 100
    });

    // /activiteit/aanmelding
    $('#activities-entry-index-table').DataTable({
        language: dutch,
        "pageLength": 50,
        "order": [[ 1, "desc" ]]
    });

    $('#user-members-table').DataTable({
        language: dutch,
        "pageLength": 50,
        "order": [[ 1, "asc" ]]
    });

    $('#user-index-table').DataTable({
        language: dutch,
        "pageLength": 50,
        "order": [[ 1, "asc" ]]
    });

    $('#activities-entry-index-table-en').DataTable({
        "pageLength": 50,
        "order": [[ 1, "desc" ]]
    });

    $('#user-index-table-en').DataTable({
        "pageLength": 50,
        "order": [[ 1, "asc" ]]
    });

    $('#user-members-table-en').DataTable({
        "pageLength": 50,
        "order": [[ 1, "asc" ]]
    });

    $('#activity-manage-table-en').DataTable({
        "pageLength": 100,
        "order": []
    });

    $('#activities-entries-table-en').DataTable({
        "pageLength": 100
    });

} );
