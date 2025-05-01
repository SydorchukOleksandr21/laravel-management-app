@extends('layouts.admin')

@section('content')
    @include('components.indexTable', [
        'header' => __('property.room.header')
])
@endsection
