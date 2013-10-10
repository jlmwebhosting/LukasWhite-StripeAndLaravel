<!DOCTYPE html>
<html>
  <head>
    <title>Sitepoint Stripe Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

  </head>
  <body>    

    <div class="container" style="padding-top: 30px;">

    @if (Session::has('message'))
        <div class="flash alert">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    @yield('content')

    </div>
    
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://js.stripe.com/v2/" type="text/javascript"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="/assets/js/app.js" type="text/javascript"></script>

    <script>
    Stripe.setPublishableKey('@stripeKey');
    </script>

  </body>
</html>