$("#submit-login").click(function(){$(this).closest("form").submit()})
$(".field4login").keypress(function(event){
	if(event.which == 13){
		$(this).closest("form").submit()}
})