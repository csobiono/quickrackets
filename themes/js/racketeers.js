$(document).ready(function(){
	$("#misc").css('display','inline-block')
	$(".search").val('Search Racketeers');
	$(".root").text('Browse Racketeers');
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/browse-root.png')")
	$('#browse-link').addClass('current');

	$(".target-option").css('display', 'block')
})

$(".search").focus(function(){$(this).val('')})
.blur(function(){$(this).val('Search Racketeers');})