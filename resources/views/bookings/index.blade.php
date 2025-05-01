@extends('layouts.admin')

@section('content')
    @include('components.indexTable', [
    'header' => __('property.guest.header')
])
@endsection
