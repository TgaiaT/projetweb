@push('js')
    <script src="/js/verif.js"></script>
@endpush

<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Merci d'indiquer vos identifiants :</h2>


            {!!Form::open(['url' => 'inscription', "onsubmit" => "return verifForm(this);"])!!}
            <div class="form-group row {!! $errors->has('name') ? 'has-error' : '' !!}">
                {!!Form::label('name', 'Prénom', ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('name', null, ['class' => 'form-control mustCheck', 'placeholder' => 'Votre prénom', "id" => "prenom", "onchange" => "verifPrenom(this)"])!!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->has('lastname') ? 'has-error' : '' !!}">
                {!!Form::label('lastname', 'Nom de famille', ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Votre nom de famille', "id" => "nom", "onchange" => "verifNom(this)"])!!}
                    {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row {!! $errors->has('email') ? 'has-error' : '' !!}">
                {!!Form::label('email', 'Email', ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::email('email', null, ['class' => 'form-control mustCheck', 'placeholder' => 'Votre adresse email', "id" => "mail", "onchange" => "verifMail(this)"])!!}
                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('password') ? 'has-error' : '' !!} row">
                {!!Form::label('password', 'Mot de passe', ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::password('password', ['class' => 'form-control mustCheck', 'placeholder' => 'Mot de passe', "id" => "pass1", "onchange" => "verifPass1(this)"])!!}
                    {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group {!! $errors->has('password_verif') ? 'has-error' : '' !!} row">
                {!!Form::label('password_verif', ' ', ['class' => 'col-sm-2 col-form-label text-left'])!!}
                <div class="col-sm-10">
                    {!!Form::password('password_verif', ['class' => 'form-control mustCheck', 'placeholder' => 'Entrez à nouveau votre mot de passe', "id" => "pass2", "onchange" => "verifPass1(this)"])!!}
                    {!! $errors->first('password_verif', '<small class="help-block">:message</small>') !!}
                </div>
            </div>

            <div class="form-group row text-center">
                <div class="col">
                    <div class="form-check">
                        <input name="cgu" class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            J'ai accepté les conditions d'utilisation du site
                        </label>
                        {!! $errors->first('cgu', '<br><small class="help-block">:message</small>') !!}
                        <a href="/mentions"><br>Voir les mentions légales</a>
                    </div>
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
    <div class="row text-right">
        <div class="col mx-auto">
            <a href="/connexion" class="liens">Déjà inscrit? Connectez-vous!</a>
        </div>
    </div>
</div>
