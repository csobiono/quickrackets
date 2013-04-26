$(document).ready(function(){
	$("#misc").css('display','inline-block')
	$(".search").val('Search Help');
	$(".root").text('Support');
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/support-root.png')")
	$('#support-link').addClass('current');
})

$(".search").focus(function(){$(this).val('')})
.blur(function(){$(this).val('Search Help');})