<div id="memoriesPresentation">
	<div class="conteneur">
		<h3 class="titre">Souvenirs</h3>
		<article class="explain">
			<p>
				Venez poster ici les photos des évenements passés. Likez les et commentez les! Partageons de bons souvenirs ensemble.
			</p>
			<a class="liens" href="">Acceder aux évenements passés...</a>
		</article>
		<article>
			<div class="row">
					<h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">Nom du dernier évenement passé</h5>
					<p class="date col-sm-5 col-md-5 col-lg-5 col-xl-5"> 03/24/2019 </p>	
				<img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-6 col-lg-4 col-xl-4">

				<p class="descriptionEvent col-sm-12 col-md-5 col-lg-8 col-xl-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi.</p>
				<p class="lieu col-sm-4 col-md-4 col-lg-2 col-xl-2"> Epinal</p>
				<div class="w-100"></div>
				<a class="liens" href="">Postez, likez, commentez...</a>
			</div>
		</article>
		<article>
			<div class="row cadre">
				<h5 class="titre col-sm-12 col-md-12 col-lg-12 col-xl-12">Les dernieres photos postées</h5>
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 row cadre">
					<img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-10 col-lg-12 col-xl-12">
					<div class="col-sm-12 col-md-2 col-lg-12 col-xl-12 row">
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							@php
								/*
									if(a déja liker){
										echo '<a href="le lien du dislike"><i class="far fa-heart fa-2x"></i></a>';
									} else {
										echo '<a href="le lien du like"><i class="fas fa-heart fa-2x"></i></a>';
									}

									echo le nombre de like de la photo;
								*/
							@endphp
							<a href=""><i class="far fa-heart fa-2x"></i></a> XXX
						</div>
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							<a href="{{-- le lien pour commenter --}}"><i class="far fa-comment fa-2x"></i></a>
							@php
								/*echo le nombre de commentaires*/
							@endphp
							XXX
						</div>
					</div>
				</div>


{{-- 		A REPRODUIRE EN PHP SUPPRIMMER LES OCCURENCES UNE FOIS LA FONCTION CREE			--}}


				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 row cadre">
					<img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-10 col-lg-12 col-xl-12">
					<div class="col-sm-12 col-md-2 col-lg-12 col-xl-12 row">
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							@php
								/*
									if(a déja liker){
										echo '<a href="le lien du dislike"><i class="far fa-heart fa-2x"></i></a>';
									} else {
										echo '<a href="le lien du like"><i class="fas fa-heart fa-2x"></i></a>';
									}

									echo le nombre de like de la photo;
								*/
							@endphp
							<a href=""><i class="far fa-heart fa-2x"></i></a> XXX
						</div>
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							<a href="{{-- le lien pour commenter --}}"><i class="far fa-comment fa-2x"></i></a>
							@php
								/*echo le nombre de commentaires*/
							@endphp
							XXX
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 row cadre">
					<img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-10 col-lg-12 col-xl-12">
					<div class="col-sm-12 col-md-2 col-lg-12 col-xl-12 row">
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							@php
								/*
									if(a déja liker){
										echo '<a href="le lien du dislike"><i class="far fa-heart fa-2x"></i></a>';
									} else {
										echo '<a href="le lien du like"><i class="fas fa-heart fa-2x"></i></a>';
									}

									echo le nombre de like de la photo;
								*/
							@endphp
							<a href=""><i class="far fa-heart fa-2x"></i></a> XXX
						</div>
						<div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
							<a href="{{-- le lien pour commenter --}}"><i class="far fa-comment fa-2x"></i></a>
							@php
								/*echo le nombre de commentaires*/
							@endphp
							XXX
						</div>
					</div>
				</div>

				{{--  SUPPRIMMER JUSQUE LA --}}

				{{-- WIDGET SI POSSIBLE --}}

			</div>
		</article>
	</div>
</div>