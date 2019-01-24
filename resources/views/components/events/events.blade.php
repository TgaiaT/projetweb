<div class="container">
    <div class="row">
        @foreach($events as $event)
            <div class="col-6 mx-auto">
                <h3>{{$event["name"]}}</h3>
                <p class="text-center">{{$event["description"]}}</p>
                <p class="text-right">{{$event["price"]}}<br/>{{$event["state"]}}</p>
                <p class="text-right">Nb activities : {{count($event["activities"])}}<br/>Nb pictures : {{count($event["pictures"])}}</p>
                <p class="text-right">Activities : {{print_r($event["activities"])}}<br/>Nb pictures : {{print_r($event["pictures"])}}</p>
            </div>
        @endforeach
    </div>
</div>
