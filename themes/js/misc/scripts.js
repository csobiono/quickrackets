// serialize a form to json format
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


$(document).ready(function(){
	
/* -----------------------------------
Index Page
------------------------------------ */
	/*= bars */
	$('.bar_fill').each(function(){
		var w=$(this).css('width');
		$(this).css('width',0).animate({width:w}, 1500)	
	})
	
	
	
	
/* -----------------------------------
Common Scripts
------------------------------------ */
	$( "input:submit, input[type='button']").button();
	
	/*= Datatables */
	$('.table_reports').dataTable( {
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	});
	$('.table_reports_scroll').dataTable( {
		"sScrollY": "600px",
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "sWidth": "10%", "aTargets": [ -1 ] }
		]
	} );
	
	
	/*= UI */
	$('.tcal').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			buttonImage: "/themes/images/cal.gif",
			buttonImageOnly: true,
			showOn: 'both'
	});
	
	
	/*table 2 styles*/
	$(".table2 tr:not('.skip'):odd, .table3 tr:not('.skip'):odd").addClass('odd');
	
	
	/* News */
	$('.slimscroll').slimScroll({
		height: '125px'
	});
	
})