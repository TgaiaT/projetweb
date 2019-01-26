<div id="ideeTemplate">
	<div class="conteneur row">
		{{-- Boucle PhP --}}

		<div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<article>
				<div class="cadre">
					<h5 class="titre">Titre de l'activité</h5>
					@php
						/*
						*Si je suis au moins un membre du cesi je peux strike
						*Si je suis au moins un membre du bde je peux la valider en la modifiant si je veux
						*/
					@endphp
					@include('components.fonctionAdmin')
					<p>
						je suis la description de l'idée ichier Ajouter les droits de lecture au groupe du fichier (group, read) chmod o-x fichier Supprimer les droits d'exécution aux autres utilisateurs (ther, execution) chmod a+rw dossier Ajouter les droits
					</p>
					<p class="souligne">
						Proposé par Le Nom Du Gars
					</p>
					<div>
						@php /*Chaque idée peux etre voté par un uttilisateur*/
	                    /*
	                        if(a déja voté){
	                            echo '<a href="le lien pour enlever le vote"><i class="fas fa-star fa-2x"></i></a>';
	                        } else {
	                            echo '<a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a>';
	                        }

	                        echo le nombre de vote;
	                    */
	                    @endphp
	                    <a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a> XXX
					</div>
				</div>
			</article>
		</div>

		{{-- fin du tamplate a reproduire (le reste c'est des exemples) --}}
		<div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<article>
				<div class="cadre">
					<h5 class="titre">Titre de l'activité</h5>
					@php
						/*
						*Si je suis au moins un membre du cesi je peux strike
						*Si je suis au moins un membre du bde je peux la valider en la modifiant si je veux
						*/
					@endphp
					@include('components.fonctionAdmin')
					<p>
						je suis la description de l'idée ichier Ajouter les droits de lecture au groupe du fichier (group, read) chmod o-x fichier Supprimer les droits d'exécution aux autres utilisateurs (ther, execution) chmod a+rw dossier Ajouter les droits
					</p>
					<p class="souligne">
						Proposé par Le Nom Du Gars
					</p>
					<div>
						@php /*Chaque idée peux etre voté par un uttilisateur*/
	                    /*
	                        if(a déja voté){
	                            echo '<a href="le lien pour enlever le vote"><i class="fas fa-star fa-2x"></i></a>';
	                        } else {
	                            echo '<a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a>';
	                        }

	                        echo le nombre de vote;
	                    */
	                    @endphp
	                    <a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a> XXX
					</div>
				</div>
			</article>
		</div>
		<div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<article>
				<div class="cadre">
					<h5 class="titre">Titre de l'activité</h5>
					@php
						/*
						*Si je suis au moins un membre du cesi je peux strike
						*Si je suis au moins un membre du bde je peux la valider en la modifiant si je veux
						*/
					@endphp
					@include('components.fonctionAdmin')
					<p>
						je suis la description de l'idée ichier Ajouter les droits de lecture au groupe du fichier (group, read) chmod o-x fichier Supprimer les droits d'exécution aux autres utilisateurs (ther, execution) chmod a+rw dossier Ajouter les droits
					</p>
					<p class="souligne">
						Proposé par Le Nom Du Gars
					</p>
					<div>
						@php /*Chaque idée peux etre voté par un uttilisateur*/
	                    /*
	                        if(a déja voté){
	                            echo '<a href="le lien pour enlever le vote"><i class="fas fa-star fa-2x"></i></a>';
	                        } else {
	                            echo '<a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a>';
	                        }

	                        echo le nombre de vote;
	                    */
	                    @endphp
	                    <a href="le lien pour voter"><i class="far fa-star fa-2x"></i></a> XXX
					</div>
				</div>
			</article>
		</div>

	</div>
</div>