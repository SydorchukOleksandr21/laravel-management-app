@extends('layouts.admin')

@section('content')
    @include('bookings.form', [
    'buttonUrl' => route('booking.store'),
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'model' => null
     ])
@endsection
