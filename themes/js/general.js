var pathname;
var requiredisEmpty = "";

$(document).ready(function(){
	pathname = window.location.pathname;
	$.getJSON('/register/config', function(data){
		var useUsername = data.use_username
		var useCaptcha = data.use_captcha
	})
})

$("#submit-login").click(function(){$(this).closest("form").submit()})
$(".field4login").keypress(function(event){
	if(event.which == 13){
		$(this).closest("form").submit()}
})

$("#sign-up-link").click(function(){document.location.href = '/register'})

/**
	* Process registration.
	* Post all form fields to /register.
	*
	*/
$("#submit-register").click(function(){

	$("#load-registration").css('visibility', 'visible')
	var form = $(this).closest("form")
		uName = form.find("input[name='username']").val();
		fName = form.find("input[name='firstname']").val();
		lName = form.find("input[name='lastname']").val();
		email = form.find("input[name='email']").val();
		passw = form.find("input[name='reg_password']").val();
		cpass = form.find("input[name='confirm_password']").val();
		gendr = form.find("select[name='gender']").val();
		cntry = form.find("select[name='country']").val();
		month = form.find("select[name='month']").val();
		day	  = form.find("select[name='day']").val();
		year  = form.find("select[name='year']").val();

		if(uName=='' || fName=='' || lName=='' || email=='' || passw=='' || cpass=='' || gendr==0 || cntry==0 || month==0 || day==0 || year==0)
		{
			requiredisEmpty = "You must fill in all of the fields.";
			$("#error-div").text(requiredisEmpty).css('display','block')
		}
		else
		{
			$("#error-div").css('display', 'none')

			$.post('/register/process_registration', {username : uName, firstname : fName, lastname : lName, email: email, password : passw,
				confirm_password: cpass, gender : gendr, country: cntry, month: month, day: day, year:year}
				, function(data){

				
				if(data.top_error)
				{
					requiredisEmpty = data.top_error
					$("#error-div").text(requiredisEmpty).css('display','block')
				}
				else
				{
					$.post('/login', {login : data.user_login, password : data.confirm_password, remember: 1}, function(){})
					setTimeout("window.location.reload()", 1000)
				}

			}, "json")
		}

	setTimeout("$('#load-registration').css('visibility', 'hidden')", 1000)
})