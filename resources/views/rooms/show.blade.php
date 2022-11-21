@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $category->name }}</h1>
        <div class="d-flex gap-2">
          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#newSubcategory"
            data-id="{{ $category->id }}"
          >
            Nowa sekcja
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roomNew">Nowy Pokój</button>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(count($category->rooms) > 0)
    <div class="d-flex justify-content-between align-items-center mt-4">
      <h1>Pokoje</h1>
    </div>
    <table class="table table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Data aktualizacji</th>
                <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->rooms as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$item->name}}
                </td>
                <td>{{date('d.m.Y', strtotime($item->created_at))}}</td>
                <td>{{date('d.m.Y', strtotime($item->updated_at))}}</td>
                <td class="d-flex justify-content-center">
                <button
                    class="btn btn-success btn-sm ml-2"
                    data-toggle="modal"
                    data-target="#editRoom"
                    data-id="{{ $item->id }}"
                    data-name="{{ $item->name }}"
                    onclick="edit(this)"
                    >Edytuj</button>
                    <button 
                        type="button"
                        class="btn btn-danger btn-sm ml-2"
                        data-toggle="modal"
                        data-target="#roomRemove"
                        data-id="{{ $item->id }}"
                        data-name="{{ $item->name }}"
                        onclick="removeData(this)"
                        >Usuń</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    @if(count($categories) > 0)
    <hr />
    <div class="d-flex justify-content-between align-items-center mt-4">
          <h1>Sekcje</h1>
    </div>
    <table class="table table-striped" id="sectionTable">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Data utworzenia</th>
                <th scope="col">Data aktualizacji</th>
                <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    {{$item->name}}
                </td>
                <td>{{date('d.m.Y', strtotime($item->created_at))}}</td>
                <td>{{date('d.m.Y', strtotime($item->updated_at))}}</td>
                <td class="d-flex justify-content-center">
                  <a href={{route('categories.show', $item->id)}} class="btn btn-sm btn-primary ml-2">Pokaż</a>
                <button
                    class="btn btn-success btn-sm ml-2"
                    data-toggle="modal"
                    data-target="#editCategory"
                    data-id="{{ $item->id }}"
                    data-name="{{ $item->name }}"
                    onclick="edit(this)"
                    >Edytuj</button>
                    <button 
                        type="button"
                        class="btn btn-danger btn-sm ml-2"
                        data-toggle="modal"
                        data-target="#categoryRemove"
                        data-id="{{ $item->id }}"
                        data-name="{{ $item->name }}"
                        onclick="removeData(this)"
                        >Usuń</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <a href="{{ route('categories.index') }}" class="btn btn-primary">Powrót</a>
</div>
{{-- MODAL ADD NEW ROOM --}}
<div class="modal fade" id="roomNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy Pokój</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action = "{{ route('room.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nazwa" onchange="validateName(this)" required>
            </div>
        </div>
            <input type="hidden" name="category_id" value="{{ $category->id }}">
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
{{-- END MODAL ADD NEW ROOM --}}
{{-- MODAL ADD NEW SUBCATEGORY --}}
<div class="modal fade" id="newSubcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Nowa sekcja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{ route('categories.storeSubcategory', $category->id) }}">
          @csrf
          <div class="form-group">
              <label for="name">Nazwa</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nazwa" required>
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
{{-- END MODAL ADD NEW SUBCATEGORY --}}
{{-- MODAL EDIT CATEGORY --}}

<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

{{-- END MODAL EDIT CATEGORY --}}

{{-- MODAL REMOVE CATEGORY --}}
<div class="modal fade" id="categoryRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="removeTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method='POST' id="removeSubcategoryForm">
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
{{-- END MODAL REMOVE CATEGORY --}}
{{-- MODAL EDIT ROOM --}}

<div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        </div>
        <input type="hidden" name="category_id" value="{{ $category->id }}">
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

{{-- END MODAL EDIT ROOM --}}
{{-- MODAL REMOVE ROOM --}}
<div class="modal fade" id="roomRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <input type="hidden" name="category_id" value="{{ $category->id }}">
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
  {{-- END MODAL REMOVE ROOM --}}
  <script>
    function edit(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("room.update", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
        $('#editTitle').html('Edytuj kategorię: ' + name);
        $('#editName').val(name);
    }
    function removeData(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("room.destroy", ":id") }}';
        url = url.replace(':id', id);
        var content = '<p>Czy na pewno chcesz usunąć <span class="fw-bold">'
          + name +
          '</span> ? </p><p>Operacja jest nieodwracalna!!</p>';
        $("#removeForm").attr('action', url);
        $('#removeTitle').html('Usuń kategorię: ' + name);
        $('#modalContent').html(content);
    }

    function removeSubcategory(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("categories.destroy", ":id") }}';
        url = url.replace(':id', id);
        var content = '<p>Czy na pewno chcesz usunąć <span class="fw-bold">'
          + name +
          '</span> ? </p><p>Operacja jest nieodwracalna!!</p>';
        $("#removeForm").attr('action', url);
        $('#removeTitle').html('Usuń sekcje: ' + name);
        $('#modalContent').html(content);
    }
</script>
@endsection