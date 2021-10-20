@extends('front_layout.layout')

{{-- @section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
@endsection --}}

@section('content')

<div class="container">
  <div class="pt-4" >
    <h6 style="display: none" class="alert alert-secondary text-center">
      @php $total = 0 @endphp
      @php $discount = 0 @endphp
      @foreach((array) session('cart') as $id => $details)
      @php $total += $details['price'] * $details['available_in_stock'] @endphp
      @endforeach
    </h6>
  </div>
  <div class='row pt-2 pb-4'>
    <div class='col-md-4'></div>
    <div class='col-md-4 card '>
      <form  id="form-container" method="post" >
        @csrf
        <!-- Tap element will be here -->
        <div id="element-container"></div>
        <div id="error-handler" role="alert"></div>

        <input style="display: none" name="amount" value="{{$total}}">
        <!-- Tap pay button -->
        <button id="tap-btn">Submit</button>
      </form>
    </div>
    <div class='col-md-4'></div>
  </div>
</div>
<form action="">
  <input style="" type="text" id="token" name="source_id">
</form>
@endsection
@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
  <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
  <script>
    var tap = Tapjsli('pk_test_dROwugnX02QMLCBaSt7zY85y');

    var elements = tap.elements({});

    var style = {
      base: {
        color: '#535353',
        lineHeight: '18px',
        fontFamily: 'sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: 'rgba(0, 0, 0, 0.26)',
          fontSize:'15px'
        }
      },
      invalid: {
        color: 'red'
      }
    };
    // input labels/placeholders
    var labels = {
      cardNumber:"Card Number",
      expirationDate:"MM/YY",
      cvv:"CVV",
      cardHolder:"Card Holder Name"
    };
    //payment options
    var paymentOptions = {
      currencyCode:["KWD","USD","SAR"],
      labels : labels,
      TextDirection:'rtl'
    }
    //create element, pass style and payment options
    var card = elements.create('card', {style: style},paymentOptions);
    //mount element
    card.mount('#element-container');
    //card change event listener
    card.addEventListener('change', function(event) {
      if(event.loaded){
        console.log("UI loaded :"+event.loaded);
        console.log("current currency is :"+card.getCurrency())
      }
      var displayError = document.getElementById('error-handler');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    var form = document.getElementById('form-container');
    form.addEventListener('submit', function(event) {

      tap.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('error-handler');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          var errorElement = document.getElementById('success');
          errorElement.style.display = "block";
          var tokenElement = document.getElementById('token');
          tokenElement.value = result.id;
          tapTokenHandler(token)

        }
      });
    });

  </script>


  <script>
    var form = document.getElementById('form-container');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      
      tap.createToken(card).then(function(result) {
        console.log(result);
        if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('error-handler');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server
          var errorElement = document.getElementById('success');
          errorElement.style.display = "block";
          var tokenElement = document.getElementById('token');
          tokenElement.value = result.id;
          alert(result.id)
          tapTokenHandler(token)

        }
      });
    });
    card.addEventListener('change', function(event) {
      if(event.BIN){
        console.log(event.BIN)
      }
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
  </script>

@endsection

