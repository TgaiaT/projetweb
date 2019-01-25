<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Formulaire de création d'activité</h2>

            {!!Form::open(['url' => 'idees/create'])!!}

            <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!} row">
                {!!Form::label('name', "Nom de l'activité", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Nom"])!!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!} row">
                {!!Form::label('description', "Description de l'activité", ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('description', null, ['class' => 'form-control', 'placeholder' => "Description"])!!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row text-right">
                <div class="col">
                    {!!Form::submit("Proposer l'activité", ['class' => 'btn btn-primary'])!!}
                </div>
            </div>

            {!!Form::close()!!}

        </div>
    </div>
</div>
