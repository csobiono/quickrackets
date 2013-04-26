function participate_in_racket(racket_id)
{
	var panel = $("div.pop-panel");
	var progress = 0;
	var counter = 0;
	panel.html("");

	$.post("quick-rackets/get_racket_info", {'racket_id':racket_id}, function(data){
	
		for(x in data.racket_name)
		{
			progress = (1/data.racket_available_positions[x]) * 100;

			panel.append(data.racket_name[x]+" ("+progress+"%)")
			panel.append("<br/>Posted by "+data.posted_by_name[x]+" ("+data.posted_by_login[x]+") ")
			panel.append("<br/>Posted on "+data.racket_date_created[x]+" at $"+data.racket_price[x])
			panel.append(" for "+data.racket_duration[x]+" min(s)")	

			panel.append("<br/><br/>Tasks:<br/>")
			for(y in data.tasks[x])
			{
				//x is the racket_id
				//y is the task_id
				counter++;
				panel.append(counter+". "+data.tasks[x][y]+"<br/>")
			}

			counter = 0;
			panel.append("<br/>Proofs:<br/>")
			for(y in data.proofs[x])
			{
				//x is the racket_id
				//y is the proof_id
				counter++;
				panel.append(counter+". "+data.proofs[x][y]+"<br/>")
				panel.append("<textarea class='proof-text' name='proof_"+y+"_for_"+x+"'></textarea><br/>")
			}
		}

		panel.append("Supporting Details<br/><textarea name='supporting-proof' row='10' />")
		panel.append("<br/><input type='button' onclick='javascript: submit_proof_to_participate("+racket_id+")' name='submit' />")
	}, "json")
}

function submit_proof_to_participate(racket_id)
{
	var proof_texts = new Array();
	var count = 0;

	$("textarea.proof-text").each(function(){
		
		var proof_id = new Array();
		proof_id = $(this).attr("name").split("_");

		if($(this).val() != "" || $(this).val() != null)
		{
			proof_texts[count] = $(this).val()+"BREAKFORPROOFID"+proof_id[1];
			// proof_texts = $.parseJSON('{proof_id:$(this).val()}');
		}

		count++;
	})

	$.post("quick-rackets/submit-participation", {'racket_id': racket_id,'proof_texts[]': proof_texts}, function(){

		window.location.href = '/rackets-done'
	})
}