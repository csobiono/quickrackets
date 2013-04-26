$(document).ready(function(){
	
	/*= Tabs */
	$('#tabs, #tabs2').tabs();
	/*$("#tabs").bind("tabsshow", function(event, ui) { 
		window.location.hash = ui.tab.hash;
	})
	var hash = window.location.hash;
	$(hash).click();*/
	
	var tabs_content	= $("#tabs ul").html().trim();
	var tabs_content2	= $("#tabs2 ul").html().trim();
	var search_string	= $("input[name='search_string']").val();
	
	if(tabs_content=="" && tabs_content2!=""){
		$('#tabs').hide();
	}
	if(tabs_content!="" && tabs_content2==""){
		$('#tabs2').hide();
	}
	if(tabs_content=="" && tabs_content2==""){
		$('#tabs').show();
		$('#tabs').html('<p style="font-size:12px">No Results Found for <b>'+search_string+'</b>.</p>')	
		$('#tabs2').hide();
	}
	
})