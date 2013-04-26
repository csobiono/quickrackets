$(document).ready(function() {
   $('table.display').dataTable({
        "sScrollY": "600px",
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
                "aaSorting": [[ 1, "desc" ]],
		"aoColumnDefs": [
			{ "sWidth": "10%", "aTargets": [ -1 ] }
		]
    });
    
});
