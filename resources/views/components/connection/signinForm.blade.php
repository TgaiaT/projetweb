<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Merci d'indiquer vos identifiants :</h2>


            {!!Form::open(['url' => 'inscription'])!!}
            <div class="form-group row {!! $errors->has('name') ? 'has-error' : '' !!}">
                {!!Form::label('name', 'Prénom', ['class' => 'col-sm-2 col-form-label'])!!}
                <div class="col-sm-10">
                    {!!Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Votre prénom'])!!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->has('lastname') ? 'has-error' : '' !!}">
                {!!Form::label('lastname', 'Nom de famille', ['class' => 'col-sm-2 col-form-label'])!!}
                <div class="col-sm-10">
                    {!!Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Votre nom de famille'])!!}
                    {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->has('email') ? 'has-error' : '' !!}">
                {!!Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label'])!!}
                <div class="col-sm-10">
                    {!!Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Votre adresse email'])!!}
                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!} row">
                {!!Form::label('password', 'Mot de passe', ['class' => 'col-sm-2 col-form-label'])!!}
                <div class="col-sm-10">
                    {!!Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe'])!!}
                    {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('password_verif') ? 'has-error' : '' !!} row">
                {!!Form::label('password_verif', ' ', ['class' => 'col-sm-2 col-form-label'])!!}
                <div class="col-sm-10">
                    {!!Form::password('password_verif', ['class' => 'form-control', 'placeholder' => 'Entrez à nouveau votre mot de passe'])!!}
                    {!! $errors->first('password_verif', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row text-right">
                <div class="col">
                    {!!Form::submit("S'inscrire", ['class' => 'btn btn-primary'])!!}
                </div>
            </div>
            {!!Form::close()!!}


        </div>
    </div>
</div>
