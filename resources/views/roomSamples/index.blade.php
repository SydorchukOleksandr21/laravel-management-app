@extends('layouts.admin')

@section('content')
    @include('components.indexTable', [
        'header' => __('property.room-sample.header')
])
@endsection
