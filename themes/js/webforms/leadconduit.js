
function urlencode(str) {
	return escape(str).replace(/\+/g,'%2B').replace(/%20/g, '+').replace(/\*/g, '%2A').replace(/\//g, '%2F').replace(/@/g, '%40');
}

//Additional methods for jquery validate plugin
jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, ""); 
	return this.optional(element) || phone_number.length > 9 &&
		phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");

jQuery.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg != value;
}, "This field is required.");



$(document).ready(function(){
	
	$("#form1").validate({
		rules: {
				state: {valueNotEquals: "", required: true},
				phone_home: {
					required: true,
					phoneUS: true
				},
		}
	});	
	
	
	$("#form1").submit(function(){
		if($(this).validate().checkForm()){
			if (!this.beenSubmitted) { //double form submit fix
				$('.loading').show();
				this.beenSubmitted = true;
				var self = this;
				
				postdata=escape($("#form1").serialize())
				$.ajax({
					type: 'POST',
					url: "/webforms/pers/proxypost",
					data: "post_data="+postdata,
					success: function(msg){
						self.beenSubmitted = false;
						$('.loading').hide();
						
						//alert(msg)
						ll=msg.search("success")
						if(ll>0){
							//senddatabase();
							alert('success');
						}
						else{
							
							ll2=/<reason>(.+?)<\/reason>/gim.exec(msg)[1];
							alert(ll2)
						}
					},
					error:  function() {
						self.beenSubmitted = false; // make sure they can try again
						$('.loading').hide();
					},
					dataType: 'text'
				});	
			}
		}
		return false;	
	})
	
	$(".phonefields").keyup(function(){
		this.value = this.value.replace(/[^0-9\.]/g,''); //numbers only
		
		var el=$(this);
		if (el.val().length >= el.attr('maxlength')){
			$(this).next('input:text').focus();
			return false;
		}
	}).change(function(){
		var linkto	=	$(this).attr('linkto');
		var el		= 	$("input[name='"+linkto+"']");
		var str		= 	$("input[linkto='"+linkto+"']").map(function() {
							return $(this).val();
						}).get().join('');
		el.val(str).keyup();
	})
	
})

/*
function senddatabase(){
	sa=escape($("form[action*='leadconduit']").serialize())
	$.ajax({
		type: 'POST',
		url: base_path+"leadconduit.php",
		data: "id="+nodeID+"&post_data="+sa,
		success: function(msg){
			alert("Success!");
			$("#newbut").css("cursor", "default");
		},
		dataType: 'text'
	});
}*/
/*
var send_data = function () {
	var url = escape("http://app.leadconduit.com/v2/PostLeadAction");
	postdata=escape($("form[action*='leadconduit']").serialize())
	$.ajax({
		type: 'POST',
		url: base_path+"proxypost.php",
		data: "jURL="+url+"&post_data="+postdata,
		success: function(msg){
			ll=msg.search("success")
			if(ll>0){
				senddatabase();
			}
			else{
				$("#newbut").css("cursor", "default");
				$('#newbut').removeAttr('disabled');
				ll2=/<reason>(.+?)<\/reason>/gim.exec(msg)[1];
				alert(ll2)
			}
		},
		dataType: 'text'
	});
}


$("#node-"+nodeID).after("<div id='result411'></div>")
$('#phone_home').keyup(function() {
	if($('#phone_home').val().length==10){
		$('#result411').load('/411.php?phone='+$('#phone_home').val()+' .result', function(a) {
			if($('.result p a').length){
				$(".result div.cell_email_phone, .result div.number, ol.result li div.home_indicator").remove()
				$("ol.result").css("list-style-type","none").css("list-style-position","outside").css("list-style-image","none")
				
				$(".result p a").attr("href","javascript:void(0)");
				$('.result p a').click(function() {
					theAdd=$(this).parent().parent().next().find("li.col_address").html();
					theAdd=theAdd.replace(/\t/gim,"").replace(/  /gim,"")
					$("#address1").val(theAdd)
				});
			}
			
		});
	}
});
*/