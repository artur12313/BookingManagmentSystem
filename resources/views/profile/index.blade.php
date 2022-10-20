@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Profil {{ $user->name }}</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
</div>

@endsection