@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample",
     'buttonLabel' => 'Create',
     'buttonMethod' => 'POST',
     'roomSample' => null
     ])
@endsection
