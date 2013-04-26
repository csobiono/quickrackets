$(document).ready(function(){
	$.get("racketeers/get-racketeers", function(data){

		var fname = data.firstname
		var lname = data.lastname
		var iso = data.country_iso
		var bday = data.bday
		var gender = data.gender

		var i = 0;
		for(x in fname)
		{
			i++

			$("div#racketeers-container").append("<div id='r-slot-"+x+"' class='r-slot'><div><div class='flag-slot'></div><div class='name-slot'>"+fname[x]+" "+lname[x]+"<br/>"+bday[x]+" "+gender[x]+"</div></div><div style='margin-top: 15px'>Member Since: <br/>Last Active: </div></div>")

			if(i>=4)
			{
				$("div#racketeers-container").append("<div class='r-slots-break'></div>")
				i = 0;
			}

			$("div#r-slot-"+x+" div.flag-slot").css("background-image", "url('/themes/images/flags/s/"+iso[x]+".png')")
		}
	}, "json")
});