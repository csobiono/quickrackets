//Additional methods for jquery validate plugin
$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg != value;
}, "This field is required.");


$(document).ready(function(){
		// Validate form
		$("#newcontactnote form").validate();
	
		

		
})