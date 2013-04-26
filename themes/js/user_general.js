$("#add-new-racket").click(function(){
	var location = '/start-a-racket-for-free'
	window.open(location, '_blank')
})
$('#qracket-link').click(function(){window.location.href = '/quick-rackets'})
$('#cracket-link').click(function(){window.location.href = '/created-rackets'})
$('#dracket-link').click(function(){window.location.href = '/rackets-done'})
$('#browse-link').click(function(){window.location.href = '/racketeers'})
$('#groups-link').click(function(){window.location.href = '/groups'})
$('#funds-link').click(function(){window.location.href = '/user-settings/funds'})
$('#support-link').click(function(){window.location.href = '/support/outbox'})
$('#events-link').click(function(){window.location.href = '/events'})

$('#account').click(function(){
	if($("#account-min-view-arrow").css('display') == 'block')
	{
		$("#account-min-view-arrow").css('display', 'none')
		$("#account-min-view").css('display', 'none')
	}
	else
	{
		$("#account-min-view-arrow").css('display', 'block')
		$("#account-min-view").css('display', 'block')
	}
})

/*$("body").click(function(e) {
	//alert(e.target)
      if($("#account-min-view").css('display') == 'block' && e.target.id !== 'account-min-view'){
	       	$("#account-min-view-arrow").hide()
			$("#account-min-view").hide()
      }      
})*/

function checkHorizontalScrollBar(){
	if($("#main-container").width()+8 > $(window).width())
	{
		$("#top").css('position','absolute')
		$("#account-min-view-arrow").css('position','absolute')
		$("#account-min-view").css('position','absolute')
		$("#left-nav").css('position','absolute')
		$("#top_nav").css('position','absolute')
	}
	else
	{
		$("#top").css('position','fixed')
		$("#account-min-view-arrow").css('position','fixed')
		$("#account-min-view").css('position','fixed')
		$("#left-nav").css('position','fixed')
		$("#top_nav").css('position','fixed')
	}
}

/*
$(window).resize(function(){	documentFace()	})
function documentFace(){
	var totalWidth = $(window).width()* 1;
	var gridfirstmarginleft = totalWidth * 0.15

	if(totalWidth * 0.28 > 400)
		{	var pamphlet	= totalWidth * 0.28}
	else{	var pamphlet	= 400}

	var gridlastmarginleft	= totalWidth * 0.03
	var shoutdiv			= totalWidth * 0.42

	//$("body").css('width', totalWidth+"px");
	$(".first").css('margin-left', gridfirstmarginleft+"px")
	$(".pamphlet").css('width', pamphlet+"px")
	$(".last").css('margin-left', gridlastmarginleft+"px")
	$("#shoutTag").css('width', shoutdiv+"px")
	$(".pamphlet_top").css('width', pamphlet * 0.48+"px")
	$(".pamphlet_bottom").css('width', pamphlet * 0.48+"px")
}

$("#sign_up").click(function(){
	alert('ok')
	$("<div />").attr('id', 'registration_form')
	.html("<div style='height: 300px; width: 380px; background-color:black; background-image: url('themes/images/nav-icons/arrow_up.png'); background-repeat:no-repeat; background-position: left top;'></div>")
	.appendTo($("#panels"))
})*/

function pop_panel_open(racket_id)
{
	$("div.pop-panel").css('display','inline');
	participate_in_racket(racket_id)
}

function pop_panel_close()
{
	$("div.pop-panel").css('display','none');
}