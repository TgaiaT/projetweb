@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
@endpush
@push('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script>
        $(document).ready( function () {
            table = $('#users_table').DataTable({
                ajax: {
                    url: '/personnel/users',
                    dataSrc: ''
                },
                select: true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'lastname' },
                    { data: 'email' },
                    { data: 'rank' },
                    { data: 'rank_level' }
                ],
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                    info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Pr&eacute;c&eacute;dent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
            });
            table.on('select', function () {
                $("#rows").val(JSON.stringify(table.rows({selected: true}).data()));
                $("#rowsLength").val(table.rows({selected: true}).data().length);
            });
            table.on('deselect', function () {
                $("#rows").val(JSON.stringify(table.rows({selected: true}).data()));
                $("#rowsLength").val(table.rows({selected: true}).data().length);
            });
            $("#change_rank").on('click', function () {

            });
        });
    </script>
@endpush

{{-- Title --}}
<div class="container my-4 text-left">
    <div class="row">
        <div class="col">
            <h3>Liste des utilisateurs : </h3>
        </div>
    </div>
</div>

{{-- The table --}}
<table id="users_table" class="display">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Rank</th>
            <th>Rank level</th>
        </tr>
    </thead>
</table>

{{-- Change rank button --}}
<div class="container my-4">
    <div class="row my-2">
        <div class="col">
            {!!Form::open(['url' => 'personnel/change_rank', "files" => true])!!}
                <input type="hidden" name="rowsLength" id="rowsLength">
                <input type="hidden" name="rows" id="rows">
                <div class="dropdown mx-auto text-right">
                    <button class="btn btn-outline-danger dropdown-toggle col" type="button" id="rank_toggler" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modifier le rang
                    </button>
                    <div class="dropdown-menu dropdown-menu-left text-center" aria-labelledby="rank_toggler">
                        <div class="bg-white border border-danger">
                            @foreach($ranks as $rank)
                                <button name="rank" class="dropdown-item" type="submit" value="{{$rank["id"]}}">{{$rank["name"]}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
