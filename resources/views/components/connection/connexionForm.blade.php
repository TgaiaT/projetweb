<div class="container my-5">
    <div class="row">
        <div class="col mx-auto py-2">
            <h2 class="mb-5">Merci d'indiquer vos identifiants :</h2>

			{!!Form::open(['url' => 'connexion'])!!}
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


					<div class="form-group row text-center">
						<div class="col">
							<div class="form-check">
								<input name="keepConnect" class="form-check-input" type="checkbox" id="gridCheck">
								<label class="form-check-label" for="gridCheck">
									Me connecter automatiquement durant mes prochaines connexions
								</label>
							</div>
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
            <a href="inscription">Inscription</a>
        </div>
    </div>
</div>
