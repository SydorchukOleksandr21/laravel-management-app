@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => route('room-sample.update',  ['model' => $model]),
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'model' => $model
     ])
@endsection
