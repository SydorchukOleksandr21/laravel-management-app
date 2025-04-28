@extends('layouts.admin')

@section('content')
    @include('roomSamples.form', [
    'buttonUrl' => "/room-sample/$model->id",
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'model' => $model
     ])
@endsection
