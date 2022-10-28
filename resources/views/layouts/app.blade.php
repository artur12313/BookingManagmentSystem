<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        $(document).ready(function() {
            if(document.getElementById('table')) {
             const t = $('#table').DataTable({
                "order": [[ 1, "asc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Wszystko"]],
                pageLength: parseInt(localStorage.getItem('dtPageLength')) || 10,
                 language: {
                    "emptyTable":     "Brak danych w tabeli",
                    "info":           "Pokazuje _START_ do _END_ z _TOTAL_ wyników",
                    "infoEmpty":      "Pokazuje 0 do 0 z 0 wyników",
                    "infoFiltered":   "(przefiltrowano _MAX_ wyników)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Pokaż _MENU_ wyników",
                    "loadingRecords": "Ładowanie...",
                    "processing":     "Przetwarzanie...",
                    "search":         "Szukaj:",
                    "zeroRecords":    "Nie znaleziono pasujących wyników",
                    "paginate": {
                        "first":      "Pierwszy",
                        "last":       "Ostatni",
                        "next":       "Następny",
                        "previous":   "Poprzedni"
                    },
                    "aria": {
                        "sortAscending":  ": aktywuj by sortować rosnąco",
                        "sortDescending": ": aktywuj by sortować malejąco"
                    }
                }
             });
            $('#table').on( 'length.dt', function ( e, settings, len ) {
                localStorage.setItem('dtPageLength', len);
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        }
    });

    $(document).ready(function() {
            if(document.getElementById('sectionTable')) {
             const t = $('#sectionTable').DataTable({
                "order": [[ 1, "asc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Wszystko"]],
                pageLength: parseInt(localStorage.getItem('dtPageLength')) || 10,
                 language: {
                    "emptyTable":     "Brak danych w tabeli",
                    "info":           "Pokazuje _START_ do _END_ z _TOTAL_ wyników",
                    "infoEmpty":      "Pokazuje 0 do 0 z 0 wyników",
                    "infoFiltered":   "(przefiltrowano _MAX_ wyników)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Pokaż _MENU_ wyników",
                    "loadingRecords": "Ładowanie...",
                    "processing":     "Przetwarzanie...",
                    "search":         "Szukaj:",
                    "zeroRecords":    "Nie znaleziono pasujących wyników",
                    "paginate": {
                        "first":      "Pierwszy",
                        "last":       "Ostatni",
                        "next":       "Następny",
                        "previous":   "Poprzedni"
                    },
                    "aria": {
                        "sortAscending":  ": aktywuj by sortować rosnąco",
                        "sortDescending": ": aktywuj by sortować malejąco"
                    }
                }
             });
            $('#sectionTable').on( 'length.dt', function ( e, settings, len ) {
                localStorage.setItem('dtPageLength', len);
            });
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();
        }
    });
    </script> 
</body>
</html>
