<div class="container">
    <div class="row">
        @foreach($activities as $activity)
            @if($activity["state"] == $state)
                <div class="col">
                    <div class="col mx-auto">
                        <h4>{{$activity["name"]}}</h4>
                        <p>{{$activity["description"]}}</p>
                        @if($state == "pending")
                            <p>Nombre de votes : {{count($activity["voters"])}}</p>
                            @if(session()->get("isConnected") && !in_array(session()->all()["user"]["id"], $activity["voters"]))
                                <button class="btn btn-primary">Voter pour cette activité</button>
                            @endif
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
