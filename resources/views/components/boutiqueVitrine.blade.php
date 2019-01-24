<div id="boutiqueVitrine">
	<div class="conteneur">
		<h3 class="titre">Les articles les plus populaires</h3>

		<article class="produit">
			<div class="row cadre">
				<h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">Nom du produit</h5>
				<div class="adminDiv cote col-sm-5 col-md-5 col-lg-5 col-xl-5"> 
					@include('components.fonctionAdmin'){{-- <-Arefaire au propre! --}}
				</div>
					{{-- A REPRENDRE DE LA BDD EN PHP --}}
				<img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
				<div class="descriptionProduct col-sm-12 col-md-5 col-lg-8 col-xl-8">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi.</p>
					<p class="prix">13,12€</p>
				</div>
				<div class="w-100"></div>
				<div class="cadre col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<form method="POST" action="{{--  --}}" accept-charset="UTF-8">
			            <div class="form-group row">
			                <label for="product" class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-form-label">Commande</label>
			                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
			                    <input class="form-control" placeholder="1" name="name" type="int" id="productNumber{{-- id du produit --}}">
			                </div>
			                <div class="form-group row text-right col-sm-2 col-md-2 col-lg-2 col-xl-2">
					            <input class="btn btn-primary" type="submit" value="Ajouter au pannier">
					        </div>
			            </div>
			        </form>
			    </div>
			</div>
		</article>

		{{-- JUSQE LA RECREER 3 FOIS --}}
	</div>
</div>