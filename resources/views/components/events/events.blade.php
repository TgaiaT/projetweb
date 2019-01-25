<div class="container">
    <div class="row">
        @foreach($events as $event)
            @if($event["state"] != "banned")
                <div class="col-6 mx-auto border border-primary my-5">
                    <h3 class="text-center">{{$event["name"]}}</h3>
                    <p class="text-center">{{$event["description"]}}</p>
                    <p class="text-center">{{strtotime($event["date"])}}</p>
                    <p class="text-right">{{$event["price"]}}<br/>{{$event["state"]}}</p>
                    <p class="text-right">Nb activities : {{count($event["activities"])}}<br/>Nb pictures : {{count($event["pictures"])}}</p>
                    <div class="container-fluid border">
                        @foreach($event["activities"] as $activity)
                            <div class="row">
                                <div class="col mx-auto">
                                    <h4>{{$activity["name"]}}</h4>
                                    <p>{{$activity["description"]}}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="container-fluid">
                            @foreach($event["pictures"] as $picture)
                                @if($picture["id_state"] != 2)
                                    <div class="row">
                                        <div class="col mx-auto">
                                            <img src="{{$picture["url"]}}">{{$picture["likes"]}}
                                            @foreach($picture["comments"] as $comment)
                                                @if($comment["id_state"] != 2)
                                                    <p>{{$comment["user_name"]}} {{$comment["user_lastname"]}} : {{$comment["comment"]}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
