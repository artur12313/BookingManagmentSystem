@extends('layouts.app')
@section('content')

<div class="container mx-auto mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edytuj Użytkownika {{ $user->name }}</h1>
    </div>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @method('patch')
            @csrf
            <div class="d-flex w-100 justify-content-center gap-3">
            <div class="my-3">
                <label for="name" class="form-label">{{ __('Nazwa') }}</label>
                <input value="{{ $user->name }}"  
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nazwa" required/>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="my-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input value="{{ $user->email }}"
                    type="email" 
                    class="form-control" 
                    name="email" 
                    placeholder="Email address" required/>
                @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="my-3">
                <label for="phone">{{ __('Telefon') }}</label>
                <input id="phone" class="form-control" type="text" name="phone" value="{{ $user->phone }}" required autofocus autocomplete="phone" />
            </div>
        </div>
            <div class="font-weight-light d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success btn-sm ml-2">Zapisz</button>
                <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ml-2">Wróć</a>
            </div>
        </form>
    </div>
@endsection
<script>
    document.getElementById('phone').addEventListener('input', function (e) {
      var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})/);
      e.target.value = !x[2] ? x[1] :  x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
    });
</script>