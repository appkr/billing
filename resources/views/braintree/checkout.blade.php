@extends('layouts.app')

@section('content')
  <form id="checkout" method="post" action="{{ route('braintree.charge') }}">
    {{ csrf_field() }}
    <input type="hidden" name="amount" value="10"/>
    <div id="payment-form"></div>
    <input type="submit" value="Pay $10"/>
  </form>

  <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
  <script>
    var clientToken = "{{ $clientToken }}";

    braintree.setup(clientToken, "dropin", {
      container: "payment-form"
    });
  </script>
@endsection