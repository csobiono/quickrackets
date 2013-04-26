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


		$('#client_contact_number').focusout(function() {

    		$.ajax({
			  type: "POST",
			  url: "/newsale/check-phone-duplicate",
			  data: $('#client_contact_number').serializeObject()
			}).done(function( msg ) {
			  if (msg == 1)
			  {
			    $('#notice').text('Duplicate phone number');
			    $('#btn_save_as_lead').attr("disabled", "true");
			    $('#submit').attr("disabled", "true");
			  }
			  else
			  {
			  	$('#notice').html('&nbsp;');
			    $('#btn_save_as_lead').removeAttr("disabled");
			    $('#submit').removeAttr("disabled");
			  }
			});
		});
		
		//Save as lead
		$('#btn_save_as_lead').click(function(){
			$('#save_as_lead').val('true');
			$('#process_db').val('true');
			//$("#form1").submit();
			$("#submit").click()
		})
		
		
		// On form submit
		$("#form1").submit(function(){  
			//alert(JSON.stringify($(this).serializeObject()))
			if($('#save_as_lead').val()=='false'){
				$(".switchpaymenttype:checked").click(); //update process_db flag; fix for going back to this page and the resubmit
			}
			
			$("#dialog:ui-dialog" ).dialog( "destroy" );
			
			var bill_today	= false;
			if( $('#today').val()==$('input[name="billdate"]').val() && $('#save_as_lead').val() == 'false' && $('input[name="paymenttype"]:checked').val()=='EFT' ){
				bill_today	= true;
			}
				
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
										'Proceed without capture funds': function (){
											$( this ).dialog( "close" );
											$('#process_db').val('true');
											$('#capture').val('false');
											$('#auth_comment').val( $("message",xml).text() );
											//alert('aa')
											$("#submit").click()
										},
										'Cancel': function() {
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
					
					if($('#eft_process_today').val()=='true'){ /* if paymentsgateway status returns 1 */
						return true	
					}
					
					if(bill_today==true){
						$("#submit").addClass('ajaxload');
						//alert(JSON.stringify($('#form1').serializeObject()))
						$.post("/newsale/paymentsgateway", $('#form1').serializeObject(), function(xml) {
								$("#submit").removeClass('ajaxload');
								//alert(xml);
								$("#dialog-message").attr('title',$("title",xml).text());
								$("#ui-dialog-title-dialog-message").text($("title",xml).text());
								$("#dialog_msg").text($("message",xml).text());
								
								if($("status",xml).text()==1){
									//submit form with no ajax
									$('#eft_process_today').val('true');
									$("#submit").click()
								}else{ //error
									$("#dialog-icon").removeClass('ui-icon-circle-check');
									$("#dialog-icon").addClass('ui-icon-circle-close');
									
									$( "#dialog-message" ).dialog({
										modal: true,
										buttons: {
											'Cancel': function() {
												$( this ).dialog( "close" );
											}
										}
									});
								}
								
							return false; 
						});  
						return false; 			
					}else{				
						return true;
					}
				}
			}//end if valid
		})//end submit
		

		
})