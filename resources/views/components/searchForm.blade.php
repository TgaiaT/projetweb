{{-- The searhbar for the shop --}}
@push('js')
    {{-- Script for the autocompleter --}}
    <script>
        @php
            $filteredCategories = [];
            foreach ($categories as $category)
            {
                array_push($filteredCategories, $category["name"]);
            }
        @endphp
        var categories = <?php echo json_encode($filteredCategories, JSON_HEX_TAG); ?>;
        var widget = new AutoComplete('search_bar', categories);
        $('#search_bar').on('focusout', function() {
            var values = widget.getValue();
            var categories = [];
            for (i=0; i < values.length; i++)
            {
                categories[i] = values[i][0]["value"];
            }

            $('#product_categories').val(categories);
            console.log($('#product_categories').val())
        });
    </script>
@endpush
<div class="searchForm">
	<div class="conteneur">
		<article class="explain">
			<h5 class="titre">Naviguer</h5>{{-- le formulaire de recherche de produit --}}
			<form>
				<div class="form-group">
					<div class="cadre">
						<label>Catégories : </label>
                        <div id="search_bar"></div>
                        <input id="product_categories" type="hidden" name="product_categories">
					</div>
					<div class="cadre">
						<input class="form-control" placeholder="Nom du produit" name="product_name" type="text" id="productName">
					</div>
					<div class="cadre">
						<label>Classement : </label>
						<div>
							<label>Classer par : </label>
							<input type="radio" name="product_selector" value="popularity"/>popularité
							<input type="radio" name="product_selector" value="price"/>prix
						</div>
						<div>
							<label>Par ordre : </label>
							<input type="radio" name="product_ordering" value="asc"/>croissant
							<input type="radio" name="product_ordering" value="des"/>décroissant
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
