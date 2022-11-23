@extends('layouts.app')
@section('content')
<script>
    const user_id = {!! auth()->user()->id !!};
    const categoriesWithRooms = {!! json_encode($categoriesWithRooms) !!};
    const booking = {!! json_encode($booking) !!};
    const client = {!! json_encode($client) !!};
    const room = {!! json_encode($room) !!};
</script>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edycja rezerwacji: {{$booking->room->category->name}} {{$booking->room->name}}</h1>
    </div>
    <div id="editBooking"></div>
</div>
@endsection