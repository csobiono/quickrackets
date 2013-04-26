$(document).ready(function(){
	$("#misc").css('display','inline-block')
	$(".search").val('Search Rackets Done');
	$(".root").text('Rackets Done');
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/dracket-root.png')")
	$('#dracket-link').addClass('current');
})

$(".search").focus(function(){$(this).val('')})
.blur(function(){$(this).val('Search Rackets Done');})