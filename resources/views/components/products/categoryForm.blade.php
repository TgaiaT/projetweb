@push('js')
    <script src="/js/verif.js"></script>
@endpush

<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Ajout d'une catégorie</h2>

            {!!Form::open(['url' => 'categories/create', "files" => true, "onsubmit" => "return verifForm(this);"])!!}

            <div class="form-group {!! $errors->has('category_name') ? 'has-error' : '' !!} row">
                {!!Form::label('category_name', "Nom de la catégorie", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('category_name', null, ['class' => 'form-control mustCheck', 'placeholder' => "Nom", "id" => "nom", "onchange" => "verifNom(this)"])!!}
                    {!! $errors->first('category_name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row text-right">
                <div class="col">
                    {!!Form::submit("Ajouter", ['class' => 'btn btn-primary'])!!}
                </div>
            </div>

            {!!Form::close()!!}

        </div>
    </div>
</div>
