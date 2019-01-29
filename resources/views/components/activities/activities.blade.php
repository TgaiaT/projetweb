{{-- Show the activities given by the controller --}}
<div class="container">
    <div class="conteneur row">
        @foreach($activities as $activity)
            @if($activity["state"] == $state)
                <div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <article>
                        <div class="cadre my-2 mx-auto">
                            <h4 class="titre text-left">{{$activity["name"]}}</h4>
                            <p class="">{{isset($activity["description"]) ? $activity["description"] : ""}}</p>

                            {{--
                             --     Pending events
                            --}}
                            @if($state == "pending")
                                <p class="text-right"><i class="far fa-star fa-2x"></i>{{isset($activity["voters"]) ? count($activity["voters"]) : 0}}</p>

                                {{--
                                 --     Only if the user is connected
                                --}}
                                <div class="mx-auto text-center">
                                    @if(session()->get("isConnected") && !in_array(session()->all()["user"]["id"], $activity["voters"]))
                                        {!!Form::open(['url' => 'idees/vote', "class" => "mb-2"])!!}
                                        <input name="id_activity" value="{{$activity["id"]}}" class="d-none">
                                        <input name="method" value="like" class="d-none">
                                        <button class="btn btn-outline-primary mx-auto my-2">Voter pour cette activité</button>
                                        {!!Form::close()!!}
                                    @elseif(session()->get("isConnected") && in_array(session()->all()["user"]["id"], $activity["voters"]))
                                        {!!Form::open(['url' => 'idees/vote', "class" => "mb-2"])!!}
                                        <input name="id_activity" value="{{$activity["id"]}}" class="d-none">
                                        <input name="method" value="dislike" class="d-none">
                                        <button class="btn btn-outline-primary mx-auto my-2">Retirer le vote</button>
                                        {!!Form::close()!!}
                                    @endif
                                    @if(session()->get("isConnected") && isset(session()->all()["user"]["rankLevel"]) && session()->all()["user"]["rankLevel"] >=4)
                                        {!!Form::open(['url' => 'idees/ban', "class" => "mb-2"])!!}
                                        <input name="id_activity" value="{{$activity["id"]}}" class="d-none">
                                        <input name="method" value="ban" class="d-none">
                                        <button class="btn btn-outline-primary mx-auto my-2">Bannir cette activité</button>
                                        {!!Form::close()!!}
                                    @endif
                                    @if(session()->get("isConnected") && isset(session()->all()["user"]["rankLevel"]) && session()->all()["user"]["rankLevel"] >=5)
                                        {!!Form::open(['url' => 'idees/update', "class" => "mb-2"])!!}
                                        <input name="id_activity" value="{{$activity["id"]}}" class="d-none">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="{{"dropdown" . $activity["id"]}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ajouter à un événement
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="{{"dropdown" . $activity["id"]}}">
                                                @foreach($events as $event)
                                                    <button name="id_event" class="dropdown-item" type="submit" value="{{$event["id"]}}">{{$event["name"]}}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                        {!!Form::close()!!}
                                    @endif
                                </div>
                            @endif
                            @if($state == "banned")
                                {!!Form::open(['url' => 'idees/ban', "class" => "mb-2"])!!}
                                    <input name="id_activity" value="{{$activity["id"]}}" class="d-none">
                                    <input name="method" value="unban" class="d-none">
                                    <button class="btn btn-outline-primary mx-auto my-2">Lever le bannissement</button>
                                {!!Form::close()!!}
                            @endif
                        </div>
                    </article>
                </div>
            @endif
        @endforeach
    </div>
</div>
