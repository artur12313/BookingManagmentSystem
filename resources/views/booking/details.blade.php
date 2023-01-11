@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Rezerwacja: {{$category ? $category->name : ' '}}{{$category ? ' (': ' '}}{{$booking->room->category->name}}{{$category ? ') ': ' '}}{{$booking->room->name}}</h1>
    </div>
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
            <p>Data utworzenia: {{date('d-m-Y', strtotime($client->created_at))}}</p>
            <p>Data aktualizacji: {{date('d-m-Y', strtotime($client->updated_at))}}</p>
        </div>
        <div className="col-md-6">
            <h5 className="text-decoration-underline">Dane rezerwacji</h5>
            <p>{{$category ? "Domek: $category->name " : "Domek: ".$sectionName}}</p>
            <p>{{$category ? "Sekcja: ".$sectionName : ' '}}</p>
            <p>Pokój: {{$booking->room->name}}</p>
            <p>Data przyjazdu: {{$booking->start_date}}</p>
            <p>Data wyjazdu: {{$booking->end_date}}</p>
            <p>Liczba osób dorosłych: {{$booking->adults}}</p>
            <p>Liczba dzieci bezpłatnych: {{$booking->numberOfPeople}}</p>
            <p>Liczba dzieci poniżej 9 lat objętych zniżką: {{$booking->numberOfChildren}}</p>
            <p>Status: {{$booking->status_text}}</p>
            <p>Kwota podana przy rezerwacji: {{$booking->price ? $booking->price : ' ' }} {{$booking->price ? 'zł' : ''}}</p>
            
        </div>
    </div>
    <div>
        Uwagi: {{$booking->comments ? $booking->comments : 'Brak.'}}
    </div>
    <a class="btn btn-primary mt-2" href="{{ route('booking.show') }}">{{ __('Lista rezerwacji') }}</a>
    <a class="btn btn-primary mt-2" href="{{ route('home') }}">{{ __('Strona główna') }}</a>
    <a class="btn btn-success mt-2" href="{{ route('booking.edit', $booking->id) }}">{{ __('Edytuj') }}</a>
</div>
@endsection