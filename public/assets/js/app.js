$(function () {
      
console.log('setting up pay form');

	$('#payment-form').submit(function(e) {

		var $form = $(this);

		$form.find('.payment-errors').hide();
	         
		$form.find('button').prop('disabled', true);
	 
		Stripe.createToken($form, stripeResponseHandler);
	  
		return false;
	});

});

function stripeResponseHandler(status, response) {

	var $form = $('#payment-form');
 
	if (response.error) {    
		$form.find('.payment-errors').text(response.error.message).show();
		$form.find('button').prop('disabled', false);
	} else {
      	    
	var token = response.id;       
			
		$form.append($('<input type="hidden" name="stripeToken" />').val(token));
      
		$form.get(0).submit();

	}

}