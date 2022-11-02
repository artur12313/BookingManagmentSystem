@extends('layouts.app')
@section('content')
<script>
    var categoriesWithRooms = {!! json_encode($categoriesWithRooms) !!};
</script>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dodawanie nowej rezerwacji</h1>
    </div>
    <div id="booking"></div>
</div>
@endsection