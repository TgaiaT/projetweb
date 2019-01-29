{{-- Show the basket --}}
{!!Form::open(['url' => 'panier/remove'])!!}
    <button class="btn btn-outline-danger">Vider le panier</button>
{!!Form::close()!!}
<div class="container">
    <div class="row">
        @if(isset($basket))
            @foreach($basket as $command)
                    <article class="col-sm-12 col-md border border-light mx-2 text-center">
                        <div class="cadre">
                            <h5 class="titre mx-auto text-center">{{$command["product"]["name"]}}</h5>

                            <div class="descriptionProduct text-left">
                                <p>{{$command["product"]["description"]}}</p>
                                <p class="prix">Prix : {{$command["product"]["price"]}} * {{$command["quantity"]}} €</p>
                            </div>
                        </div>
                    </article>
            @endforeach
         @endif
    </div>
</div>
{{-- Clear the basket --}}
@if(isset($basket))
    {!!Form::open(['url' => 'panier/command'])!!}
        <button class="btn btn-outline-success">Procéder à la commande</button>
    {!!Form::close()!!}
@endif

