{{-- Show products given by the controller --}}
<div class="conteneur">
    <div class="container">
        <div class="row">
            @foreach($products as $prod)
                @if($prod["state"] != "banned")
                    <article class="produit my-4 col-sm-12 col-md-6 col-lg-4 border border-secondary mx-auto">

                        {{-- Ban button --}}
                        @if(session("isConnected") && session()->all()["user"]["rankLevel"] >=4)
                            <div class="mx-auto my-2">
                                {!!Form::open(['url' => 'products/ban'])!!}
                                <input name="method" value="ban" class="d-none">
                                <input class="d-none" name="id_product" value="{{$prod["id"]}}">
                                <button type="submit" class="btn btn-outline-danger col">Bannir ce produit</button>
                                {!!Form::close()!!}
                            </div>
                        @endif

                        {{-- Add category button --}}
                        @if(session("isConnected") && session()->all()["user"]["rankLevel"] >=4)
                            {!!Form::open(['url' => 'product/update', "class" => "mb-2"])!!}
                            <input type="hidden" name="id_product" value="{{$prod["id"]}}" class="d-none">
                            <div class="dropdown mx-auto text-right">
                                <button class="btn btn-secondary dropdown-toggle col" type="button" id="{{"dropdown" . $prod["id"]}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ajouter une catégorie à ce produit
                                </button>
                                <div class="dropdown-menu" aria-labelledby="{{"dropdown" . $prod["id"]}}">
                                    <div class="bg-secondary border border-light">
                                        @foreach($categories as $category)
                                            @if(!in_array($category["name"], $prod["categories"]))
                                                <button name="id_category" class="dropdown-item" type="submit" value="{{$category["id"]}}">{{$category["name"]}}</button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {!!Form::close()!!}
                        @endif

                        <div class="row cadre">
                            <h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">{{$prod["name"]}}</h5>

                            <div class="pleins col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <img src="{{$prod["picture"]}}" alt="{{$prod["name"]}}" class="img-fluid">
                            </div>

                            <div class="descriptionProduct col-sm-12 col-md-5 col-lg-8 col-xl-8">
                                <p>{{$prod["description"]}}</p>
                                <p class="prix">Prix : {{$prod["price"]}} €<br/>Disponibilité : {{$prod["state"]}}</p>
                            </div>
                            <div class="w-100"></div>

                            @if(session()->get("isConnected") && $prod["state"] != "sold out")
                                {!!Form::open(['url' => 'boutique'])!!}
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <div class="row mx-auto mt-3">
                                            <label for="quantity" class="col">Quantité</label>
                                            <input type="hidden" class="d-none" name="product" value="{{json_encode($prod)}}">
                                            <div class="col">
                                                {{Form::number('quantity', 1,  ["class" => "form-control"])}}
                                                {!! $errors->first('quantity', '<small class="help-block">:message</small>') !!}
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto mt-3">
                                            <input class="btn btn-primary col" type="submit" value="Ajouter au pannier">
                                        </div>
                                    </div>
                                </div>
                                {!!Form::close()!!}
                            @endif
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
    </div>
</div>
