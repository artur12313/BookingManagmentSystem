@extends('layouts.app')
@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Rodzaje domków</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryNew">Nowy Rodzaj</button>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(count($categories) > 0)
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
        @else
        <p>Brak Domków w bazie</p>
        @endif
</div>
{{-- MODAL ADD NEW CATEGORY --}}
<div class="modal fade" id="categoryNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Nowy rodzaj</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action = "{{ route('categories.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nazwa</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nazwa" onchange="validateName(this)" required>
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
{{-- END MODAL ADD NEW CATEGORY --}}
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
{{-- END MODAL REMOVE CATEGORY --}}
<script>
    function edit(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("categories.update", ":id") }}';
        url = url.replace(':id', id);
        $("#editForm").attr('action', url);
        $('#editTitle').html('Edytuj kategorię: ' + name);
        $('#editName').val(name);
    }
    function removeData(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("categories.destroy", ":id") }}';
        url = url.replace(':id', id);
        var content = '<p>Czy na pewno chcesz usunąć <span class="fw-bold">'
          + name +
          '</span> ? </p><p>Operacja jest nieodwracalna!!</p>';
        $("#removeForm").attr('action', url);
        $('#removeTitle').html('Usuń kategorię: ' + name);
        $('#modalContent').html(content);
    }
</script>
@endsection