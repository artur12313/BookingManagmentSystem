@extends('layouts.app')
@section('content')
<script>
    var user_id = {!! auth()->user()->id !!};
    var categoriesWithRooms = {!! json_encode($categoriesWithRooms) !!};
    var booking = {!! json_encode($booking) !!};
    var client = {!! json_encode($client) !!};
    var room = {!! json_encode($room) !!};
    var selectedCategory = {!! json_encode($selectedCategory) !!};
    console.log(selectedCategory);
</script>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edycja rezerwacji: {{$booking->room->category->name}} {{$booking->room->name}}</h1>
    </div>
    <div id="editBooking"></div>
</div>
@endsection