@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample/$roomSample->id",
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'roomSample' => $roomSample
     ])
@endsection
