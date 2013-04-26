var campTitleText = ''
var avPositions = ''

$(document).ready(function(){
	$("#misc").css('display','inline-block')
	$(".search").val('Search Quick Rackets');
	$(".root").text('Quick Rackets');
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/qracket-root.png')")
	$('#qracket-link').addClass('current');

	campTitleText = $("#camp_title").val()
	avPositions = $("#av_positions").val()
})

$(".search").focus(function(){$(this).val('')})
.blur(function(){$(this).val('Search Quick Rackets');})

$("#add_campaign").click(function(){
	alert('Add Campaign')
})

$("#camp_title").focus(function(){
	if($("#camp_title").val() == campTitleText)
	{
		$("#camp_title").val('')
	}
}).blur(function(){
	if($("#camp_title").val() == '')
	{
		$("#camp_title").val(campTitleText)
	}
})

$("#av_positions").focus(function(){
	if($("#av_positions").val() == avPositions)
	{
		$("#av_positions").val('')
	}
}).blur(function(){
	if($("#av_positions").val() == '')
	{
		$("#av_positions").val(avPositions)
	}
})

//dummy is a temporary class
$("#show-hidden-rackets").click(function(){
	$(this).removeAttr('id')
	$(this).attr('id', 'hide-hidden-rackets')
	/*$("#show-hidden-rackets").addClass('dummy')
	$("#show-hidden-rackets").removeAttr('id')
	$(".dummy").attr('id', 'hide-hidden-rackets')
	$("#hide-hidden-rackets").removeAttr('class')*/
})

$("#hide-hidden-rackets").click(function(){
	$(this).removeAttr('id')
	$(this).attr('id', 'show-hidden-rackets')
})