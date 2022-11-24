@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Rezerwacja: {{$categoryName}} ({{$booking->room->category->name}}) {{$booking->room->name}}</h1>
    </div>
<script>
    console.log('');
</script>
    <div class="d-flex col-md-12 mt-4 justify-content-around">
        <div className="col-md-6">
            <h5 className="text-decoration-underline">Dane klienta</h5>
            <p>Imię: {{$client->name}}</p>
            <p>Nazwisko: {{$client->lastName}}</p>
            <p>Email: {{$client->email}}</p>
            <p>Telefon: {{$client->phone}}</p>
            <p>Miasto: {{$client->city}}</p>
            <p>Kod pocztowy: {{$client->postalCode}}</p>
            <p>Klient: {{$client->client_text}}</p>
        </div>
        <div className="col-md-6">
            <h5 className="text-decoration-underline">Dane rezerwacji</h5>
            <p>Domek: {{$categoryName}}</p>
            <p>Sekcja: {{$booking->room->category->name}}</p>
            <p>Pokój: {{$booking->room->name}}</p>
            <p>Data przyjazdu: {{$booking->start_date}}</p>
            <p>Data wyjazdu: {{$booking->end_date}}</p>
            <p>Liczba osób objętych zniżką: {{$booking->numberOfPeople}}</p>
            <p>Status: {{$booking->status_text}}</p>
            <p>Kwota podana przy rezerwacji: {{$booking->price ? $booking->price : ' ' }} {{$booking->price ? 'zł' : ''}}</p>
        </div>
    </div>
    <div>
        Uwagi: {{$booking->comments ? $booking->comments : 'Brak.'}}
    </div>
    <a class="btn btn-primary mt-2" href="{{ route('booking.show') }}">{{ __('Powrót') }}</a>
    <a class="btn btn-success mt-2" href="{{ route('booking.edit', $booking->id) }}">{{ __('Edytuj') }}</a>
</div>
@endsection