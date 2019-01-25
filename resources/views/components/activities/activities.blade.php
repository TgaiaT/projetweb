<div class="container">
    <div class="row">
        @foreach($activities as $activity)
            @if($activity["state"] == $state)
                <div class="col-5 my-2 mx-auto border border-secondary">
                    <h4 class="text-left">{{$activity["name"]}}</h4>
                    <p class="border-top border-bottom border-dark">{{isset($activity["description"]) ? $activity["description"] : ""}}</p>
                    @if($state == "pending")
                        <p class="text-right">Votes : {{isset($activity["voters"]) ? count($activity["voters"]) : 0}}</p>
                        @if(session()->get("isConnected") && !in_array(session()->all()["user"]["id"], $activity["voters"]))
                            <button class="btn btn-outline-primary mx-auto my-2">Voter pour cette activité</button>
                        @endif
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
