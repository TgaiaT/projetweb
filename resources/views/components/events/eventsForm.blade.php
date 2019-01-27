<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Formulaire de création d'événement</h2>

            {!!Form::open(['url' => 'event/create'])!!}

            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!} row">
                {!!Form::label('name', "Nom de l'événement", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Nom"])!!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!} row">
                {!!Form::label('description', "Description de l'événement", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => "Description"])!!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('date') ? 'has-error' : '' !!} row">
                {!!Form::label('date', "Date de l'événement", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::date('date', null, ['class' => 'form-control'])!!}
                    {!! $errors->first('date', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('price') ? 'has-error' : '' !!} row">
                {!!Form::label('price', "Prix de l'événement", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Prix'])!!}
                    {!! $errors->first('price', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('location') ? 'has-error' : '' !!} row">
                {!!Form::label('location', "Lieu de l'événement", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Localisation'])!!}
                    {!! $errors->first('location', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!} row">
                {!!Form::label('image', "Lien de l'image", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('image', null, ['class' => 'form-control', 'placeholder' => '(Optionnel)'])!!}
                    {!! $errors->first('image', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row text-right">
                <div class="col">
                    {!!Form::submit("Créer l'événement", ['class' => 'btn btn-primary'])!!}
                </div>
            </div>

            {!!Form::close()!!}

        </div>
    </div>
</div>
