@extends('layouts.admin')

@section('content')
    @include('rooms.form', [
    'buttonUrl' => "/room",
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'model' => null
     ])
@endsection
