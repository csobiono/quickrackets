var instructionField = new Array();
var proofField = new Array();
var i = 1;
var runningForm;
var progressValue;
var desiredInputLength;
var neededMultipleFieldOnPage = "";
//RACKETS ATTRIBUTES
var racketName;
var racketDuration;
var racketCategoryId;
var racketTasks = new Array();
var racketProofs = new Array();
var racket_is_public = 1;

$(document).ready(function(){
	progressValue = 34;
	$("#progressbar").progressbar({
		value: progressValue
	});

	$(".root").text('Start a Quick Racket')
	$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/create-racket.png')")

	desiredInputLength = 5;
	$(".prev-part-btn").addClass('not-working-btn')
	$(".submit-racket-btn").css('visibility','hidden')

	$("#make-racket-public").attr('checked','checked')
	runningForm = 1;
	neededMultipleFieldOnPage = "instruction"

	instructionField.push('1', '2')
	proofField.push('1', '2')

	runForm(runningForm)
})

function runForm(id)
{
	$("#add-racket-part-"+id+"-of-3").css('display', 'block')

}

$(".next-part-btn").click(function(){
	
	var confirmNotWorking = $(this).attr('class').split(' ')

	if(confirmNotWorking.length != 2)
	{
		$("#add-racket-part-"+runningForm+"-of-3").css('display', 'none')
		runningForm = runningForm + 1;
		progressValue = progressValue + 33
		$("#progressbar").progressbar({
			value: progressValue
		});

		setBCumbsforForm()

		runForm(runningForm)
	}
})

$(".prev-part-btn").click(function(){
	
	var confirmNotWorking = $(this).attr('class').split(' ')

	if(confirmNotWorking.length != 2)
	{
		$("#add-racket-part-"+runningForm+"-of-3").css('display', 'none')
		runningForm = runningForm - 1;
		progressValue = progressValue - 33
		$("#progressbar").progressbar({
			value: progressValue
		});

		setBCumbsforForm()

		$(".next-part-btn").removeClass('not-working-btn')
		runForm(runningForm)
	}
})

/*-------------Getting Targets-------------*/
$("input[name='main-target-option']").change(function(){
	if($(this).attr('id') == 'choose-racket-target')
	{
		$(".target-option").css('display', 'block')
	}
	else
	{
		$(".target-option").css('display', 'none')
	}

	chosenTarget = $(this).attr('id')
})

$(".target-name").click(function(){

	if($(this).attr('checked'))
	{
		$("#nodes-for-"+$(this).attr('id')).css('display', 'block')
		$("."+$(this).attr('id')+"-range").attr('checked','checked')
		$(this).closest(".target-option").css('border-top', '1px black solid')
		.css('border-bottom', '1px black solid')
		.css('margin', '10px 0 10px 0')
		.css('padding', '5px 0 8px 0')
	}
	else
	{
		$("#nodes-for-"+$(this).attr('id')).css('display', 'none')
		$("."+$(this).attr('id')+"-range").removeAttr('checked')
		$(this).closest(".target-option").css('border-top', '0')
		.css('border-bottom', '0')
		.css('margin', '0 0 0 0')
		.css('padding', '5px 0 0 0')
	}
})
/*-----------------------------------------*/

$(".submit-racket-btn").click(function(){
	
	$("input[name='main-target-option']").each(function(){
		if($(this).attr('checked') == 'checked' && $(this).attr("id") == 'choose-racket-target')
		{
			racket_is_public = 0;
		}
	})
	/*Getting Tasks and Proofs List*/
	var taskCounter = 0;
	var proofCounter = 0;

	$(".form-field").each(function()
 	{
 		var fieldId = $(this).attr("id").split('-');

 		if(fieldId[1] == "instruction")
 		{
 			racketTasks[taskCounter] = $(this).val();
 			taskCounter++;
 		}
 		else if(fieldId[1] == "proof")
 		{
 			racketProofs[proofCounter] = $(this).val();
 			proofCounter++;
 		}
 	})
	/*-----------------------------*/

 	racketName = $("input#rtitle").val();
 	racketDuration = $("select#min-to-finish").val()
 	racketCategoryId = $("select#racket-category").val()

 	/*Post all basic info of a racket to be inserted*/
	$.post('/start-a-racket-for-free/new-racket', 	
		{'racket_name' : racketName, 
		 'racket_price' : 0.02, 
		 'available_pos' : 3, 
		 'tasks[]' : racketTasks,
		 'duration' : racketDuration, 
		 'category_id' : racketCategoryId, 
		 'is_public' : racket_is_public,
		 'proofs[]' : racketProofs}, 

		 function(){
		 	window.location.href = '/created-rackets'
	});
	/*------------------------------*/
})

function setBCumbsforForm(){
		if(runningForm == 1)
		{
			neededMultipleFieldOnPage = "instruction"

			$(".prev-part-btn").addClass('not-working-btn')
			$(".root").text('Start a Quick Racket')
			$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/create-racket.png')")
			$(".root").css("margin-left", "10px")
			$(".submit-racket-btn").css('visibility','hidden')
			$(".next-part-btn").css('display','inline-block')
		}

		if(runningForm == 2)
		{
			$(".root").text('Choose Your Targets')
			$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/target.png')")
			$(".root").css("margin-left", "510px")
			$(".prev-part-btn").removeClass('not-working-btn')
			$(".submit-racket-btn").css('visibility','hidden')
			$(".next-part-btn").css('display','inline-block')
		}
		
		if(runningForm == 3)
		{
			neededMultipleFieldOnPage = "proof"

			$(".root").text('Get Some Proofs')
			$(".root").css("background-image", "url('/themes/images/nav-icons/top-nav/proof.png')")
			$(".root").css("margin-left", "975px")
			$(".next-part-btn").css('display','none')
			$(".submit-racket-btn").css('visibility','visible')
		}
}

function seeMore(fieldId, eventTarget)
{	
	eventTarget = eventTarget.next()
	if(eventTarget.text() == '')
	{
		alert(eventTarget.attr('class'))
		eventTarget.html('')
		$.post('/get_website_content/form_instructions', {field_id : fieldId}, function(data){
			eventTarget.html(data)
			eventTarget.css('display', 'block')
		})
	}
	else
	{
		eventTarget.html('');
	}
}

$(".form-field").focus(function(){
	$(this).css('border', '2px solid #0e0e0e')	
}).focusout(function(){
	$(this).css('border', '2px solid #848484')
})

function removeField(racketNum){

	var currentLength
	
	if(neededMultipleFieldOnPage == "instruction")
	{ 
		currentLength = instructionField.length
	}
	else if(neededMultipleFieldOnPage == "proof")
	{
		currentLength = proofField.length
	}

	if(currentLength > 1)
	{
		$("#"+neededMultipleFieldOnPage+"-field-num-"+currentLength).css('display','none')

		if(neededMultipleFieldOnPage == "instruction")
		{ 
			instructionField = $.grep(instructionField, function(value) {
				return value != racketNum;
			})
		}
		else if(neededMultipleFieldOnPage == "proof")
		{
			proofField = $.grep(proofField, function(value) {
				return value != racketNum;
			})
		}

		var wrapper = $("#racket-"+neededMultipleFieldOnPage+"-"+racketNum).parent()
		wrapper.remove()
	}

	if(currentLength == 2)
	{
		$(".remove-"+neededMultipleFieldOnPage+"-field").css('display','none')
	}

	if(currentLength <= desiredInputLength)
	{
		$(".add-"+neededMultipleFieldOnPage+"-field").css('display','inline')
	}

	$("#"+neededMultipleFieldOnPage+"s-list").after().css('display', 'inline')
}

function addField(){

	var addLength

	if(neededMultipleFieldOnPage == "instruction")
	{ 
		addLength = instructionField.length+1
	}
	else if(neededMultipleFieldOnPage == "proof")
	{
		addLength = proofField.length+1
	}
	
	var totalLength = addLength-1

	if(totalLength != desiredInputLength)
	{
		var currentLength; //for fields

		do
		{
			if($("#racket-"+neededMultipleFieldOnPage+"-"+i).length == 0)
			{
				$("<div />").html("<input id='racket-"+neededMultipleFieldOnPage+"-"+i+"' name='racket-"+neededMultipleFieldOnPage+"-"+i+"' class='form-field' maxLenght='124' />"
						+"&nbsp;&nbsp;<a href='#' onclick='removeField("+i+")' class='remove-"+neededMultipleFieldOnPage+"-field'>Remove</a>")
				.appendTo($("#"+neededMultipleFieldOnPage+"s-list"))

				if(neededMultipleFieldOnPage == "instruction")
				{ 
					instructionField.push(i)
					currentLength = instructionField.length
				}
				else if(neededMultipleFieldOnPage == "proof")
				{
					proofField.push(i)
					currentLength = proofField.length
				}
				
				$("#"+neededMultipleFieldOnPage+"-field-num-"+currentLength).css('display','block')

				if(currentLength == desiredInputLength)
				{
					$(".add-"+neededMultipleFieldOnPage+"-field").css('display','none')
				}

				if(currentLength >= 2)
				{
					$(".remove-"+neededMultipleFieldOnPage+"-field").css('display','inline')
				}
			}
			else
			{
				i++;
			}	
		}while(currentLength != addLength)
	}

	i = 1
}
