<div id="boutiqueVitrine">
	<div class="conteneur">
		<h3 class="titre">Les articles les plus populaires</h3>

		<div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<article class="produit">
				<div class="row cadre">
					<h5 class="titre cadre">Nom du produit</h5>
					<div> 
						@include('components.fonctionAdmin'){{-- <-Arefaire au propre! --}}
					</div>
						{{-- A REPRENDRE DE LA BDD EN PHP --}}
					<div class="cadre col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    					<img src="./images/bde.jpg" alt="imageEvent" class="img-fluid">
					</div>
					<div class="descriptionProduct col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi.</p>
						<p class="prix">13,12€</p>
					</div>
					<div class="w-100"></div>
					<div class="cadre col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<form method="POST" action="{{--  --}}" accept-charset="UTF-8">
				            <div class=" row">
				                <label for="product" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Commande</label>
				                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5">
				                    <input class="form-control" placeholder="1" name="name" type="int" id="productNumber{{-- id du produit --}}">
				                </div>
				            </div>
				            <div>
						            <input class="btn btn-primary" type="submit" value="Ajouter au pannier">
						        </div>
				        </form>
				    </div>
				</div>
			</article>
		</div>

		{{-- JUSQE LA RECREER 3 FOIS --}}
	</div>
</div>