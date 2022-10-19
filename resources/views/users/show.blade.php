@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista Użytkowników</h1>
    </div>
        <div>
            Nazwa: <span class="font-weight-bold">{{ $user->name }}</span>
        </div>
        <div>
            Email: <span class="font-weight-bold">{{ $user->email }}</span>
        </div>
        <div>
            Nr. telefonu: <span class="font-weight-bold">{{ $user->phone }}</span>
        </div>
        <div>
            Posiada konto od: <span class="font-weight-bold">{{ date('d.m.Y', strtotime($user->created_at)) }}</span>
        </div>
        <div class="font-weight-light d-flex gap-2 mt-4">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm ml-2">Edytuj</a>
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ml-2">Wróć</a>
        </div>
    </div>
@endsection