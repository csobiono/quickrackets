
//Additional methods for jquery validate plugin
$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg != value;
}, "This field is required.");

function dialog_loading(){
	$(".ui-dialog-titlebar, .ui-dialog-content, .ui-dialog-buttonpane").css('visibility','hidden');
	$(".ui-dialog").addClass('ajaxload-center');
}

function dialog_unloading(){
	$(".ui-dialog-titlebar, .ui-dialog-content, .ui-dialog-buttonpane").css('visibility','visible');
	$(".ui-dialog").removeClass('ajaxload-center');
}

$(document).ready(function(){
    $('.table_reports_scroll_billing').dataTable( {
		"sScrollY": "600px",
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
        "aaSorting": [[ 1, "desc" ]],
		"aoColumnDefs": [
			{ "sWidth": "10%", "aTargets": [ -1 ] }
		]
	} );

	$('.table_reports_scroll_billing_delayed').dataTable( {
		"sScrollY": "600px",
		"bScrollCollapse": true,
		"bPaginate": false,
		"bJQueryUI": true,
        "aaSorting": [[ 2, "desc" ]],
		"aoColumnDefs": [
			{ "sWidth": "10%", "aTargets": [ -1 ] }
		]
	} );


	$('a[href="#"]').click(function(){return false;})
	$('.process').click(function(){
		$("#dialog:ui-dialog" ).dialog( "destroy" );
			
		$("#dialog-message").attr('title','Please Confirm');
		$("#ui-dialog-title-dialog-message").text('Confirm');
		$("#dialog_msg").text('Are you sure you want to process this payment?');
		
		/*$("#dialog-icon").removeClass('ui-icon-circle-close');
		$("#dialog-icon").addClass('ui-icon-circle-check');*/
		$("#dialog-icon").addClass('ui-icon-alert');
		
		var _form	= $(this).closest('form');
		var _url	= $(this).closest('form').attr('action');
		var _tr		= $(this).closest('tr');
		
		$( "#dialog-message" ).dialog({
			modal: true,
			buttons: {
				'Yes': function (){
					//$( this ).dialog( "close" );
					//_form.submit();
					//alert(JSON.stringify(_form.serializeObject()))
					dialog_loading();
					$.post(_url, _form.serializeObject(),function(xml){
						dialog_unloading();
						$("#dialog-message").attr('title',$("title",xml).text());
						$("#ui-dialog-title-dialog-message").text($("title",xml).text());
						$("#dialog_msg").text($("message",xml).text());
						
						if($("status",xml).text()==1){
							
							//$('#authorization_code').val( $("authorization_code",xml).text() );
							
							$("#dialog-icon").removeClass('ui-icon-circle-close');
							$("#dialog-icon").addClass('ui-icon-circle-check');
							
							$( "#dialog-message" ).dialog({
								modal: true,
								buttons: {
									OK: function() {
										$( this ).dialog( "close" );
										/*_tr.fadeOut(600,function(){
											$(this).remove()	
										});*/
										_tr.addClass('processed');
										_tr.find('td').addClass('processed');
										_tr.find('.process').closest('td').html('[processed]')
										//_tr.find('.process').remove();
									}
								}
							});
						}else{ //error
							$("#dialog-icon").removeClass('ui-icon-circle-check');
							$("#dialog-icon").addClass('ui-icon-circle-close');
							
							
							$( "#dialog-message" ).dialog({
								modal: true,
								buttons: {
									OK: function() {
										$( this ).dialog( "close" );
										/*_tr.fadeOut(600,function(){
											$(this).remove()	
										});*/
										_tr.addClass('processed');
										_tr.find('td').addClass('processed');
										_tr.find('.process').closest('td').html('[Declined]')
										//_tr.find('.process').remove();
									}
								}
							});
						}
					})
				},
				No: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	return false;	
	})
	$('.process-propay').click(function(){
		$("#dialog:ui-dialog" ).dialog( "destroy" );
			
		$("#dialog-message").attr('title','Please Confirm');
		$("#ui-dialog-title-dialog-message").text('Confirm');
		$("#dialog_msg").text('Are you sure you want to process this payment?');
		
		/*$("#dialog-icon").removeClass('ui-icon-circle-close');
		$("#dialog-icon").addClass('ui-icon-circle-check');*/
		$("#dialog-icon").addClass('ui-icon-alert');
		
		var _form	= $(this).closest('form');
		var _url	= $(this).closest('form').attr('action');
		var _tr		= $(this).closest('tr');
		
		$( "#dialog-message" ).dialog({
			modal: true,
			buttons: {
				'Yes': function (){
					//$( this ).dialog( "close" );
					//_form.submit();
					//alert(JSON.stringify(_form.serializeObject()))
					dialog_loading();
					$.post(_url, _form.serializeObject(),function(xml){
						dialog_unloading();
						$("#dialog-message").attr('title',$("title",xml).text());
						$("#ui-dialog-title-dialog-message").text($("title",xml).text());
						$("#dialog_msg").text($("message",xml).text());
						
						if($("status",xml).text()==1){
							
							//$('#authorization_code').val( $("authorization_code",xml).text() );
							
							$("#dialog-icon").removeClass('ui-icon-circle-close');
							$("#dialog-icon").addClass('ui-icon-circle-check');
							
							$( "#dialog-message" ).dialog({
								modal: true,
								buttons: {
									OK: function() {
										$( this ).dialog( "close" );
										/*_tr.fadeOut(600,function(){
											$(this).remove()	
										});*/
										_tr.addClass('processed');
										_tr.find('td').addClass('processed');
										_tr.find('.process-propay').closest('td').html('[processed]')
										//_tr.find('.process').remove();
									}
								}
							});
						}else{ //error
							$("#dialog-icon").removeClass('ui-icon-circle-check');
							$("#dialog-icon").addClass('ui-icon-circle-close');
							
							
							$( "#dialog-message" ).dialog({
								modal: true,
								buttons: {
									OK: function() {
										$( this ).dialog( "close" );
										/*_tr.fadeOut(600,function(){
											$(this).remove()	
										});*/
										_tr.addClass('processed');
										_tr.find('td').addClass('processed');
										_tr.find('.process-propay').closest('td').html('[declined]')
										//_tr.find('.process').remove();
									}
								}
							});
						}
					})
				},
				No: function() {
					$( this ).dialog( "close" );
				}
			}
		});	
	return false;	
	})
})