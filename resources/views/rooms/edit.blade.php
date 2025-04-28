@extends('layouts.admin')

@section('content')
    @include('rooms.form', [
    'buttonUrl' => "/room/$model->id",
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'model' => $model
     ])
@endsection
