$(document).ready(function(){
	$("#misc").css('display','inline-block')
	$(".search").val('Search Created Rackets');
	$(".root").text('Created Rackets');
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/cracket-root.png')")
	$('#cracket-link').addClass('current');
})

$(".search").focus(function(){$(this).val('')})
.blur(function(){$(this).val('Search Created Rackets');})

