@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample",
     'buttonLabel' => 'Create',
     'buttonMethod' => 'POST',
     'roomSample' => null
     ])
@endsection
