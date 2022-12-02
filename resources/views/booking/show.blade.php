@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista rezerwacji</h1>
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
    @if(count($bookings) > 0)
        <table class="table table-striped" id="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Klient</th>
                    <th scope="col">Pokój</th>
                    <th scope="col">Dodano przez:</th>
                    <th scope="col">Rezerwacja od:</th>
                    <th scope="col">Rezerwacja do:</th>
                    <th scope="col">Status:</th>
                    <th scope="col" class="text-center">Narzędzia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$item->client->name}}
                        {{$item->client->lastName}}
                    </td>
                    <td>
                        {{$item->room->category->name}}
                        {{$item->room->name}}
                    </td>
                    <td>
                        {{$item->user->name}}
                    </td>
                    <td>
                        {{$item->start_date}}
                    </td>
                    <td>
                        {{$item->end_date}}
                    </td>
                    <td>
                        {{$item->status_text}}
                    </td>
                    <td class="d-flex justify-content-center">
                      <a href={{route('booking.details', $item->id)}} class="btn btn-sm btn-primary ml-2">Pokaż</a>
                    <a class="btn btn-success btn-sm ml-2" href="{{ route('booking.edit', $item->id) }}">Edytuj</a>
                        <button 
                            type="button"
                            class="btn btn-danger btn-sm ml-2"
                            data-toggle="modal"
                            data-target="#reservationRemove"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->name }}"
                            data-lastName="{{ $item->lastName }}"
                            data-category="{{ $item->room->category->name }}"
                            data-room="{{ $item->room->name }}"
                            data-user="{{ $item->user->name }}"
                            data-start_date="{{ $item->start_date }}"
                            data-end_date="{{ $item->end_date }}"
                            data-status="{{ $item->status }}"
                            data-numberOfPeople="{{ $item->numberOfPeople }}"
                            data-price="{{ $item->price }}"
                            data-comments="{{ $item->comments }}"
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

{{-- MODAL REMOVE RESERVATION --}}
<div class="modal fade" id="reservationRemove" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeTitle">Usuń rezerwację</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method='POST' id="removeForm">
            @csrf
            @method('DELETE')
            <div id="modalContent">
                <p>Czy na pewno chcesz usunąć tą <span class="fw-bold"> rezerwację </span> ? </p><p>Operacja jest nieodwracalna!!</p>
            </div>
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
  {{-- END MODAL REMOVE RESERVATION --}}

<script>
    function removeData(element) {
        var id = $(element).data('id');
        var name = $(element).data('name');
        var url = '{{ route("booking.destroy", ":id") }}';
        url = url.replace(':id', id);
        $("#removeForm").attr('action', url);
    }
</script>
@endsection