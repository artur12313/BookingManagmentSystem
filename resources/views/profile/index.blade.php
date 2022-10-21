@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Profil</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="profileManagment my-4">
        <div class="row">
            <div class="col-5">
                <h3>Informacje o Profilu</h3>
                <p>Zaktualizuj informacje w swoim profilu i adres e-mail.</p>
            </div>
            <div class="col-7">
                <div class="card">
                    <form method="POST" action="{{ route('profile.update', $user->id) }}">
                        @method('patch')
                        @csrf
                        <div class="card-body p-4">
                            <div class="form-group col-6">
                                <label for="name">Nazwa</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="profileManagment my-4">
        <div class="row">
            <div class="col-5">
                <h3>Zaktualizuj Hasło</h3>
                <p>Upewnij się, że Twoje konto używa długiego, losowego hasła, aby zachować bezpieczeństwo.</p>
            </div>
            <div class="col-7">
                <div class="card">
                    <form method="POST" action="{{ route('profile.password', $user->id) }}">
                        @method('patch')
                        @csrf
                        <div class="card-body p-4">
                            <div class="form-group col-6">
                                <label for="current_password">Obecne Hasło</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="form-group col-6">
                                <label for="password">Nowe Hasło</label>
                                <input type="password" class="form-control" id="password" name="password" onchange="validatePassword(this)" onchange="validatePassword(this)">
                                <div id="passwordResult"></div>
                            </div>
                            <div class="form-group col-6">
                                <label for="password_confirmation">Potwierdź Hasło</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" onchange="comparePasswords(this)">
                                <div id="compareResult"></div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submitPassword">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#submitPassword').attr('disabled', true);

    function validatePassword(e) {
        let passwordInput = $(e);
        let password = $(e).val();
        let current_password = $('#current_password').val();
        let passwordResult = $("#passwordResult");
        if(password == null || password == '') {
            passwordInput.attr('style', "border: 1px solid red;");
            passwordResult.html('<ul style="margin-top: 1rem;"><li>Zalecane małe i wielkie litery</li><li>Zalecana długość przynajmniej 8 znaków</li><li>Zalecane użycie znaków specjalnych</li></ul>');
        } else {
            if(password == current_password)
            {
                passwordInput.attr('style', "border: 1px solid red;");
                passwordResult.html('<ul style="margin-top: 1rem;"><li>Hasła nie mogą być takie same</li></ul>');
            } else {
                passwordInput.attr('style', "border: 1px solid green; color: green");
                passwordResult.html('');
            }
        }
        return false;
      }

    function comparePasswords(e) {
        let result = $("#compareResult");
        let password = $("#password").val();
        let password_confirmation = $(e).val();
        let password_confirmationInput = $(e);
        if(password == password_confirmation) {
            password_confirmationInput.attr('style', "border: 1px solid green; color: green;");
            result.html('');
            $('#submitPassword').attr('disabled', false);
        } else {
            password_confirmationInput.attr('style', "border: 1px solid red; color: red");
            result.html('<ul style="margin-top: 1rem;"><li>Hasła nie są identyczne</li></ul>');
        }
        return false;
    }

    $('#phone').on('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})/);
        e.target.value = !x[2] ? x[1] :  x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
    });
</script>
@endsection