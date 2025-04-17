@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample",
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'roomSample' => null
     ])
@endsection
