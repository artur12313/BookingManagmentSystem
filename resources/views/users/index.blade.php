@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista Użytkowników</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userNew">Nowy Użytkownik</button>
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
                    <th scope="col">Telefon</th>
                    <th scope="col">Data utworzenia</th>
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
                    <td>{{$user->phone}}</td>
                    <td>{{date('d.m.Y', strtotime($user->created_at))}}</td>
                    <td class="d-flex justify-content-center">
                    <button
                        class="btn btn-success btn-sm ml-2"
                        data-toggle="modal"
                        data-target="#editUser"
                        data-id="{{ $user->id }}"
                        data-name="{{ $user->name }}"
                        data-email="{{ $user->email }}"
                        data-phone="{{ $user->phone }}"
                        onclick="editUser(this)"
                        >Edytuj</button>
                        <button 
                            type="button"
                            class="btn btn-danger btn-sm ml-2"
                            data-toggle="modal"
                            data-target="#userRemove"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            onclick="removeData(this)"
                            >Usuń</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Brak Użytkowników w bazie</p>
        @endif
</div>
{{-- MODAL ADD NEW USER --}}
<div class="modal fade" id="userNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy Użytkownik</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action = "{{ route('users.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nazwa" onchange="validateName(this)" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" onchange="validateEmail(this)" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" class="form-control phone" id="phone" name="phone" placeholder="telefon" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Hasło" onchange="validatePassword(this)" onclick="validatePassword(this)" required>
                <div id="passwordResult"></div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Powtórz hasło</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Powtórz hasło" onchange="comparePasswords(this)" onclick="comparePasswords(this)" required>
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
{{-- END MODAL ADD NEW USER --}}
{{-- MODAL EDIT USER --}}

<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" id="editForm">
            @method('patch')
            @csrf
            <div class="d-flex flex-column w-100 justify-content-center">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nazwa') }}</label>
                <input
                    id="editName"
                    type="text" 
                    class="form-control" 
                    name="name" 
                    placeholder="Nazwa" required/>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input
                    id="editEmail"
                    type="email" 
                    class="form-control" 
                    name="email"
                    placeholder="Email" required/>
            </div>
            <div class="mb-3">
                <label for="editPhone">{{ __('Telefon') }}</label>
                <input id="editPhone" class="form-control phone" type="text" name="phone" required />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Edytuj</button>
            </div>
        </form>
        </div>
        </div>
      </div>
    </div>
  </div>

{{-- END MODAL EDIT USER --}}
{{-- MODAL REMOVE USER --}}
  <div class="modal fade" id="userRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method='POST' id="removeForm">
            @csrf
            @method('DELETE')
            <div id="modalContent"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger">Usuń</button>
        </div>
            </form>
        </div>
      </div>
    </div>
  </div>
{{-- END MODAL REMOVE USER --}}
    <script>
      function regexEmail(email) {
        let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return res.test(email);
      }
      function validateEmail(e) {
        let emailInput = $(e);
        let email = $(e).val();
        if(regexEmail(email)) {
            emailInput.attr('style', "border: 1px solid green; color: green");
        } else {
            emailInput.attr('style', "border: 1px solid red; color: red");
        }
        return false;
      }

      function validateName(e) {
        let nameInput = $(e);
        let name = $(e).val();
        if(name == null || name == '') {
            nameInput.attr('style', "border: 1px solid red; color: red");
        } else {
            nameInput.attr('style', "border: 1px solid green; color: green");
        }
        return false;
      }

      function validatePassword(e) {
        let passwordInput = $(e);
        let password = $(e).val();
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

      function comparePasswords(e) {
        let result = $("#compareResult");
        let password = $("#password").val();
        let password_confirmation = $(e).val();
        let password_confirmationInput = $(e);
        if(password == password_confirmation) {
            password_confirmationInput.attr('style', "border: 1px solid green; color: green;");
            result.html('');
        } else {
            password_confirmationInput.attr('style', "border: 1px solid red; color: red");
            result.html('<ul style="margin-top: 1rem;"><li>Hasła nie są identyczne</li></ul>');
        }
        return false;
      }

      function removeData(e) {
        let id = $(e).data('id');
        let name = $(e).data('name');
        let modalTitle = $("#removeTitle");
        let modalContent = $("#modalContent");
        let modalForm = $("#removeForm");
        modalForm.attr('action', '/users/' + id + '/delete');
        modalContent.html('<p>Czy na pewno chcesz usunąć użytkownika ' + '<span class="fw-bold">' + name + '</span>' + '?</p><p>Operacja jest nieodwracalna!!</p>');
        modalTitle.html('Usuń użytkownika: ' + name);
      }

      function editUser(e) {
        let id = $(e).data('id');
        let name = $(e).data('name');
        let email = $(e).data('email');
        let phone = $(e).data('phone');
        let modalTitle = $("#editTitle");
        let modalName = $("#editName");
        let modalEmail = $("#editEmail");
        let modalPhone = $("#editPhone");
        let modalForm = $("#editForm");
        modalForm.attr('action', '/users/' + id + '/update');
        modalName.val(name);
        modalEmail.val(email);
        modalPhone.val(phone);
        modalTitle.html('Edytuj użytkownika: ' + name);
      }

      $('.phone').on('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})/);
        e.target.value = !x[2] ? x[1] :  x[1] + ' ' + x[2] + (x[3] ? ' ' + x[3] : '');
    });
    </script>
@endsection