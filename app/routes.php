<?php

Route::get('/', function()
{
	$downloads = Download::get();	
	return View::make('index', array('downloads' => $downloads));
});

Route::get('/buy/{id}', function($id)
{
	$download = Download::find($id);	
	return View::make('buy', array('download' => $download));
});

Route::post('/buy/{id}', function($id)
{
	Stripe::setApiKey(Config::get('laravel-stripe::stripe.api_key'));
	
	$download = Download::find($id);

	$token = Input::get('stripeToken');

	// Charge the card
	try {
		$charge = Stripe_Charge::create(array(
			"amount" => $download->price,
			"currency" => "gbp",
			"card" => $token,
			"description" => 'Order: ' . $download->name)
		);

		// If we get this far, we've charged the user successfully
		Session::put('purchased_download_id', $download->id);
		return Redirect::to('confirmed');
			
	} catch(Stripe_CardError $e) {
		// Payment failed
		return Redirect::to('buy/'.$id)->with('message', 'Your payment has failed.');		
	}

});

Route::get('/confirmed', function()
{
	$download = Download::find(Session::get('purchased_download_id'));
	return View::make('confirmed', array('download' => $download));
});

Route::get('/download/{id}', function($id)
{
	$download = Download::find($id);		
	if ((Session::has('purchased_download_id') && (Session::get('purchased_download_id') == $id))) {
		Session::forget('purchased_download_id');
		return Response::download(storage_path().'/'.$download->filepath);	
	} else {
		App::abort(401, 'Access denied');
	}
});