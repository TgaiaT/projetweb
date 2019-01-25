<div class="container">
   <div class="row">
        @foreach($products as $prod)
            <div class="col-6 mx-auto">
                <h3>{{$prod["name"]}}</h3>
                <img src="{{$prod["picture"]}}" alt="{{$prod["name"]}}"/>
                <p class="text-center">{{$prod["description"]}}</p>
                <p class="text-right">{{$prod["price"]}}<br/>{{$prod["state"]}}</p>
            </div>
        @endforeach
    </div>
</div>
