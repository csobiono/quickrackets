var list = new Array(1, 2, 3, 4)

$(document).ready(function(){

	$(".slide_1_top").addClass('slide_current')
	$(".slide_1_bottom").addClass('slide_current')

})

$(".slide_btn").click(function(){
	var classes = $(this).attr('class').split(' ')
	var listLoc = classes[1].split('_')

	if(classes.length == 2)
	{
		for(x in list)
		{	
			if($(".slide_"+list[x]+"_top").attr('class').split(' ').length == 3)
			{	
				$(".slide_"+list[x]+"_top").removeClass('slide_current')
				$(".slide_"+list[x]+"_bottom").removeClass('slide_current')
			}
		}

		$(this).addClass('slide_current')
		if(listLoc[2] == 'top')
		{
			$(".slide_"+listLoc[1]+"_bottom").addClass('slide_current')
		}
		else
		{
			$(".slide_"+listLoc[1]+"_top").addClass('slide_current')
		}

		if(listLoc[1] == 1)
		{
			$("#slide").css("background-color", "red"); 
		}
		else if(listLoc[1] == 2)
		{
			$("#slide").css("background-color", "blue");	
		}
		else if(listLoc[1] == 3)
		{
			$("#slide").css("background-color", "green"); 
		}
		else
		{
			$("#slide").css("background-color", "yellow"); 	
		}
	}
})
