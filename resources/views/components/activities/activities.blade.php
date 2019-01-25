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
                        @if(session()->get("isConnected") && isset(session()->all()["user"]["rankLevel"]))
                            <form method="POST" action="/idees/update" class="mb-2">
                                <input value="{{$activity["id"]}}" class="d-none">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="{{"dropdown" . $activity["id"]}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ajouter à un événement
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="{{"dropdown" . $activity["id"]}}">
                                        @foreach($events as $event)
                                        @endforeach
                                        <button class="dropdown-item" type="submit">Action</button>
                                        <button class="dropdown-item" type="submit">Another action</button>
                                        <button class="dropdown-item" type="submit">Something else here</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            @endif
        @endforeach
    </div>
</div>
