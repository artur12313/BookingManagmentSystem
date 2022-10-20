@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista Użytkowników</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#user">Nowy klient</button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(count($users) > 0)
        <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">E-mail</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>{{$user->email}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm ml-2">Pokaż</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm ml-2">Edytuj</a>
                        <form method='POST' action="{{ route('users.destroy', $user->id) }}" style='display:inline'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-2">Usuń</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Brak klientów w bazie</p>
        @endif
</div>
<div class="modal fade" id="user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy klient</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action = "{{ route('users.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nazwa" onchange="validateName()" onclick="validateName()" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" onchange="validateEmail()" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Hasło" onchange="validatePassword()" onclick="validatePassword()" required>
                <div id="passwordResult"></div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Powtórz hasło</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Powtórz hasło" onchange="comparePasswords()" onclick="comparePasswords()" required>
                <div id="compareResult"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </div>
            </form>
        </div>
      </div>
    </div>
  </div>
    <script>
      function regexEmail(email) {
        let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return res.test(email);
      }
      function validateEmail() {
        let emailInput = $("#email");
        let email = $("#email").val();
        if(regexEmail(email)) {
            emailInput.attr('style', "border: 1px solid green; color: green");
        } else {
            emailInput.attr('style', "border: 1px solid red; color: red");
        }
        return false;
      }

      function validateName() {
        let nameInput = $("#name");
        let name = $("#name").val();
        if(name == null || name == '') {
            nameInput.attr('style', "border: 1px solid red; color: red");
        } else {
            nameInput.attr('style', "border: 1px solid green; color: green");
        }
        return false;
      }

      function validatePassword() {
        let passwordInput = $("#password");
        let password = $("#password").val();
        let passwordResult = $("#passwordResult");
        if(password == null || password == '') {
            passwordInput.attr('style', "border: 1px solid red;");
            passwordResult.html('<ul style="margin-top: 1rem;"><li>Zalecane małe i wielkie litery</li><li>Zalecana długość przynajmniej 8 znaków</li><li>Zalecane użycie znaków specjalnych</li></ul>');
        } else {
            passwordInput.attr('style', "border: 1px solid green; color: green");
            passwordResult.html('');
        }
        return false;
      }

      function comparePasswords() {
        let result = $("#compareResult");
        let password = $("#password").val();
        let password_confirmation = $("#password_confirmation").val();
        let password_confirmationInput = $("#password_confirmation");
        if(password == password_confirmation) {
            password_confirmationInput.attr('style', "border: 1px solid green; color: green;");
            result.html('');
        } else {
            password_confirmationInput.attr('style', "border: 1px solid red; color: red");
            result.html('<ul style="margin-top: 1rem;"><li>Hasła nie są identyczne</li></ul>');
        }
        return false;
      }
    </script>
@endsection