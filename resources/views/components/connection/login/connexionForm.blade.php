{{-- The connection form --}}
@push('js')
    <script src="/js/verif.js"></script>
@endpush

<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Merci d'indiquer vos identifiants :</h2>

			{!!Form::open(['url' => 'connexion', "onsubmit" => "return verifForm(this);"])!!}
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
							{!!Form::password('password', ['class' => 'form-control mustCheck', 'placeholder' => 'Mot de passe', "id" => "pass", "onchange" => "verifPass(this)"])!!}
							{!! $errors->first('password', '<small class="help-block">:message</small>') !!}
						</div>
					</div>


					<div class="form-group row text-right">
						<div class="col">
							{!!Form::submit('Se connecter', ['class' => 'btn btn-primary'])!!}
						</div>
					</div>
				{!!Form::close()!!}

        </div>
    </div>
    <div class="row">
        <div class="col mx-auto text-right">
            <a href="inscription">Pas encore de compte? Inscrivez-vous!</a>
        </div>
    </div>
</div>
