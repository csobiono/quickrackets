$(document).ready(function(){

	 $('#transaction_history_results').dataTable( {
		"sScrollY": "600px",
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
        "aaSorting": [[ 1, "desc" ]],
		"aoColumnDefs": [
			{ "sWidth": "10%", "aTargets": [ -1 ] }
		]
	} );

	$("input[name='date_from'], input[name='date_to']").focus(function(){
	
		$("input[value='drop_down_range']").removeAttr("checked");
		$("input[value='date_selector']").attr("checked", "checked");
	})
	
	$("select[name='all_activity']").focus(function(){
	
		$("input[value='date_selector']").removeAttr("checked");
		$("input[value='drop_down_range']").attr("checked", "checked");
	})

	$(".ui-datepicker-trigger").click(function(){
	
		$("input[value='drop_down_range']").removeAttr("checked");
		$("input[value='date_selector']").attr("checked", "checked");
	})
	
	$("select[name='all_activity']").change(function(){
	
		$("input[name='date_from']").attr("value","");
		$("input[name='date_to']").attr("value","");
	})
})
