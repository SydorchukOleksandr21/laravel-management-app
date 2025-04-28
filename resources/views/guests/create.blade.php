@extends('layouts.admin')

@section('content')
    @include('guests.form', [
    'buttonUrl' => route('guest.store'),
     'buttonLabel' => __('label.create'),
     'buttonMethod' => 'POST',
     'model' => null
     ])
@endsection
