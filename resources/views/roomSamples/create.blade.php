@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample",
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'model' => null
     ])
@endsection
