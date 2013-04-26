//Additional methods for jquery validate plugin
$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg != value;
}, "This field is required.");


$(document).ready(function(){

		$(".addnewuser").click(function(){
         $('#listusers').css('display','none');
         $('#addnewlink').css('display','none');
			$('#adduser').css('display','block');
   	})
   	
   	$(".changedpassword").click(function(){
         $('#addnewlink').css('display','none');
   	})
   	
   	$(".updateinfo").click(function(){
           $('#addnewlink').css('display','none');
	   })
		
		// Validate form
		$("#form1").validate({
			rules: {
				billing_state: {valueNotEquals: "", required: true}
			},
			errorPlacement: function(error, element) {
				error.insertBefore(element);
			},
			/*submitHandler: function(form) {
				$(form).ajaxSubmit();
			}*/
		});
	
		
		
		
		

		
})