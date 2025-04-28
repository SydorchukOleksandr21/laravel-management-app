@extends('layouts.admin')

@section('content')
    @include('guests.form', [
    'buttonUrl' => route('guest.update', ['model' => $model]),
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'model' => $model
     ])
@endsection
