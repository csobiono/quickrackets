//Additional methods for jquery validate plugin
$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg != value;
}, "This field is required.");

$(document).ready(function(){
		// Switch CreditCard / Bank Info
		$(".switchpaymenttype").click(function(){
				var v=this.value;
				if(v=="EFT"){
					$('#bank_info').css('display','');
					$('#creditcard_info').css('display','none');
					$('#process_db').val('true');
				}else{
					$('#creditcard_info').css('display','');
					$('#bank_info').css('display','none');
					//$('#process_db').val('false');
					$('#process_db').val( $('#process_db_override').val() );
					
				}
				
		})
		//$(".switchpaymenttype:checked").click();
		//$(".switchpaymenttype:checked").click();
		
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
	
		
		
		// On form submit
		$("#form1").submit(function(){  
			//alert(JSON.stringify($(this).serializeObject()))
			
			$(".switchpaymenttype:checked").click(); //update process_db flag; fix for going back to this page and the resubmit
			
			$("#dialog:ui-dialog" ).dialog( "destroy" );
			
			if( $("#form1").valid() ) {
				
				if( $('#process_db').val()=='false' ){
				
					$("#submit").addClass('ajaxload');
					
					$.post("/newsale/authorize", $('#form1').serializeObject(), function(xml) {
							$("#submit").removeClass('ajaxload');
							//alert(xml);
							$("#dialog-message").attr('title',$("title",xml).text());
							$("#ui-dialog-title-dialog-message").text($("title",xml).text());
							$("#dialog_msg").text($("message",xml).text());
							
							if($("status",xml).text()==1){
								
								$('#authorization_code').val( $("authorization_code",xml).text() );
								
								$("#dialog-icon").removeClass('ui-icon-circle-close');
								$("#dialog-icon").addClass('ui-icon-circle-check');
								
								$( "#dialog-message" ).dialog({
									modal: true,
									buttons: {
										'Proceed with capture funds': function() {
											$( this ).dialog( "close" );
											$('#process_db').val('true');
											$('#capture').val('true');
											$('#auth_comment').val( $("message",xml).text() );
											//alert('aa')
											$("#submit").click()
										},
										'Proceed without capture funds': function (){
											$( this ).dialog( "close" );
											$('#process_db').val('true');
											$('#capture').val('false');
											$('#auth_comment').val( $("message",xml).text() );
											//alert('aa')
											$("#submit").click()
										},
										Cancel: function() {
											$( this ).dialog( "close" );
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
										}
									}
								});
							}
							
						return false; 
					});  
				return false; 
				}//end if process_db
				else{
				//$("#form1").submit()
				return true;
				}
			}//end if valid
		})//end submit
		

		
})