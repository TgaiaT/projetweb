<div id="connexionContent">
	<h1 class="titre">Connexion</h1>
	<div class="conteneur">
		<article>
			<h3 class="titre">Rentrez vos identifiants:</h3>
			<form method="POST" action="{{-- A RENTREZ ICI --}}" accept-charset="UTF-8"><input name="_token" type="hidden" value="{{-- bpQ7vlXxenwdnr6YPpzYY1C97Lbw2ii53U9Xk77h --}}">
				<div class="form-group row ">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input class="form-control" placeholder="Votre adresse email" name="email" type="email" id="email">	
					</div>
				</div>
				<div class="form-group  row">
					<label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
					<div class="col-sm-10">
						<input class="form-control" placeholder="Mot de passe" name="password" type="password" value="" id="password">		
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
						<input class="btn btn-primary" type="submit" value="Se connecter">
					</div>
				</div>
			</form>
			<a href="./inscription" class="liens">Pas encore de compte? Inscrivez-vous!</a>
		</article>
	</div>
</div>