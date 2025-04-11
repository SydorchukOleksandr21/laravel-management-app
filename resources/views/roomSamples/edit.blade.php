@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample/$roomSample->id",
     'buttonLabel' => 'Update',
     'buttonMethod' => 'PUT',
     'roomSample' => $roomSample
     ])
@endsection
