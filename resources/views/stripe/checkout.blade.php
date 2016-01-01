@extends('layouts.app')

@section('content')
  <form  action="{{ route('stripe.subscribe') }}" method="POST">
    {{ csrf_field() }}
    <script
      src="https://checkout.stripe.com/checkout.js"
      class="stripe-button"
      data-key="pk_test_jkPMR1SeWzdd1ojQrlnnzvKm"
      data-amount="100"
      data-name="Demo Site"
      data-description="1 widgets ($1.00)"
      data-image="/images/heartocat.png"
      data-locale="auto">
    </script>
  </form>
@endsection