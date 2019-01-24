<div id="inscriptionContent">
	<h1 class="titre">Inscription</h1>
	<div class="conteneur">
		<article>
			<h5 class="titre">Rentrez vos informations:</h5>
			<form method="POST" action="{{--  --}}" accept-charset="UTF-8"><input name="_token" type="hidden" value="{{--  --}}">
	            <div class="form-group row ">
	                <label for="name" class="col-sm-2 col-form-label">Pr&eacute;nom</label>
	                <div class="col-sm-10">
	                    <input class="form-control" placeholder="Votre prénom" name="name" type="text" id="name">
	                    
	                </div>
	            </div>

	            <div class="form-group row ">
	                <label for="lastname" class="col-sm-2 col-form-label">Nom de famille</label>
	                <div class="col-sm-10">
	                    <input class="form-control" placeholder="Votre nom de famille" name="lastname" type="text" id="lastname">
	                    
	                </div>
	            </div>

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

	            <div class="form-group  row">
	                <label for="password_verif" class="col-sm-2 col-form-label"> </label>
	                <div class="col-sm-10">
	                    <input class="form-control" placeholder="Entrez à nouveau votre mot de passe" name="password_verif" type="password" value="" id="password_verif">
	                    
	                </div>
	            </div>

	            <div class="form-group row text-right">
	                <div class="col">
	                    <input class="btn btn-primary" type="submit" value="S&#039;inscrire">
	                </div>
	            </div>
            </form>
			<a href="http://localhost/projetweb/server.php/connexion" class="liens">Déjà inscrit? Connectez-vous!</a>
		</article>
	</div>
</div>