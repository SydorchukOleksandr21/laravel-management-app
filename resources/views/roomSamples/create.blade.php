@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => route('room-sample.store'),
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'model' => null
     ])
@endsection
