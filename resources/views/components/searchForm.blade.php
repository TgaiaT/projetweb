<div class="searchForm">
	<div class="conteneur">
		<article class="explain">
			<h5 class="titre">Naviguer</h5>{{-- le formulaire de recherche de produit --}}
			<form>
				<div class="form-group">
					<div class="cadre">
						<label>Catégories : </label>
						<div id="search_bar" class=""></div>
					</div>
					<div class="cadre">
						<input class="form-control" placeholder="Nom du produits" name="productName" type="text" id="productName">
					</div>
					<div class="cadre">
						<label>Classement : </label>
						<div>
							<label>Classer par : </label>
							<input type="radio" name="classement" value="popularite"/>popularité
							<input type="radio" name="classement" value="prix"/>prix
						</div>
						<div>
							<label>Par ordre : </label>
							<input type="radio" name="ordre" value="croissant"/>croissant
							<input type="radio" name="ordre" value="decroissant"/>décroissant
						</div>
					</div>
					<div class="form-group text-right">
		                <div>
		                    <input class="btn btn-primary" type="submit" value="Rechercher">
		                </div>
		            </div>
				</div>
			</form>
		</article>
	</div>
</div>