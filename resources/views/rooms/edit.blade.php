@extends('layouts.admin')

@section('content')
    @include('rooms.form', [
    'buttonUrl' => "/room/$room->id",
     'buttonLabel' => __('label.edit'),
     'buttonMethod' => 'PUT',
     'room' => $room
     ])
@endsection
