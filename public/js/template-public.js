$(document).ready(function(){
	$('#header-button').click(function(){
		$(".header-mobile-show").toggle();

		if($(".header-button").hasClass('change')){$(".header-button").removeClass('change');}
		else{$(".header-button").addClass('change');}
	});

	$('#form-login').submit(function(){
		let notError = true;
		$("#form-login .validate").each(function(entry, index, array) {
			let teste = validateInput($(index));
			if(!teste && notError == true)
			{
				notError = false;
			}
		});

		return notError ? true : false;
	});

	$('.validate').keypress(function(){
		validateInput($(this));
	});
});

function validateInput(input){
	if(input.val() && (input.attr('type') != 'email' || isEmail(input.val()))){
		input.removeClass("invalid").addClass("valid");
		input.next().hide();
		return true;
	}
	else
	{
		input.removeClass("valid").addClass("invalid");
		input.next().show();
		return false;
	}
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}