<div id="memories">
    @foreach($events as $event)
        @if($event["state"] != "banned")
            <div class="container conteneur">
                {{-- A event --}}
                <article>
                    <div class="cadre">
                        {{-- The body of the event --}}
                        <div class="row">
                            <h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">{{$event["name"]}}</h5>
                            <p class="date col-sm-5 col-md-5 col-lg-5 col-xl-5">{{date('d/m/Y' ,strtotime($event["date"]))}}</p>
                            <div class="pleins col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                <img src="{{$event["image"]}}" alt="imageEvent" class="img-fluid">
                            </div>

                            <div class="col-sm-12 col-md-5 col-lg-8 col-xl-8">
                                <p class="descriptionEvent">{{$event["description"]}}</p>
                                <p class="lieu">{{$event["location"]}}</p>
                                <p class="prix">{{"Prix : " . $event["price"] . " €"}}</p>
                            </div>
                            <div class="w-100"></div>
                        </div>

                        {{-- Ban button --}}
                        @if(session("isConnected") && session()->all()["user"]["rankLevel"] >=4)
                        <div class="mx-auto my-2">
                            {!!Form::open(['url' => 'event/ban'])!!}
                                <input name="method" value="ban" class="d-none">
                                <input class="d-none" name="id_event" value="{{$event["id"]}}">
                                <button type="submit" class="btn btn-outline-danger col">Bannir cet événement</button>
                            {!!Form::close()!!}
                        </div>
                        @endif

                        {{-- boutton du premier collapse "en savoir plus" --}}
                        <div class="cadre my-2">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$event["id"]}}" aria-expanded="false" aria-controls="collapseExample">
                                {{($timeline == "future") ? "Voir les activités" : "Voir les posts"}}
                            </button>
                        </div>

                        {{-- Extra of the event : activity or posts --}}
                        <div class="collapse" id="collapse{{$event["id"]}}">
                            {{-- Ici on met ce que contient le collapse. deux possibilités: --}}
                            <div class="container-fluid bg-light border border-light">

                                {{-- CAS 1 : Evénement a venir --}}
                                @if($timeline == "future")
                                    <ul>
                                        @foreach($event["activities"] as $activity)
                                            <li class="mb-2">
                                                <p class="souligne">{{$activity["name"]}} :</p>
                                                <div class="row">
                                                    <p class="col">{{$activity["description"]}}</p>
                                                    @if(session("isConnected") && (!isset($activity["registered"]) || !in_array(session()->all()["user"]["id"], $activity["registered"])))
                                                    {!!Form::open(['url' => 'event/register'])!!}
                                                        <input name="method" value="register" class="d-none">
                                                        <input class="d-none" name="id_activity" value="{{$activity["id"]}}">
                                                        <button type="submit" class="btn btn-secondary col">S'inscrire</button>
                                                    {!!Form::close()!!}
                                                    @elseif(session("isConnected") && (in_array(session()->all()["user"]["id"], $activity["registered"])))
                                                    {!!Form::open(['url' => 'event/register'])!!}
                                                        <input name="method" value="unregister" class="d-none">
                                                        <input class="d-none" name="id_activity" value="{{$activity["id"]}}">
                                                        <button type="submit" class="btn btn-secondary col">Se désincrire</button>
                                                    {!!Form::close()!!}
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                {{-- CAS 2 : Evénement passés : une boucle en php va généré un article pour chaque photo--}}
                                @if($timeline == "past")
                                    <div class="container-fluid">
                                        <div class="row cadre">

                                        {{-- A picture --}}
                                        @foreach($event["pictures"] as $picture)
                                            {{-- Check if the photo isn't banned --}}
                                            @if($picture["id_state"] != 2)
                                                <div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                    <article>
                                                        {{-- Ban button --}}
                                                        @if(session("isConnected") && session()->all()["user"]["rankLevel"] >=4)
                                                            <div class="mx-auto my-2">
                                                                {!!Form::open(['url' => 'products/ban'])!!}
                                                                <input name="method" value="ban" class="d-none">
                                                                <input class="d-none" name="id_picture" value="{{$picture["id"]}}">
                                                                <button type="submit" class="btn btn-outline-danger col">Bannir cette photo</button>
                                                                {!!Form::close()!!}
                                                            </div>
                                                        @endif
                                                        {{-- The image of the picture--}}
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                            <img src="{{$picture["url"]}}" alt="imageEvent" class="img-fluid">
                                                        </div>

                                                        {{-- Like and comments box --}}
                                                        <div class="pleins col row mx-auto">

                                                            {{-- Likes number --}}
                                                            <div class="col">
                                                                {!!Form::open(['url' => 'event/like'])!!}
                                                                    <input class="d-none" name="id_picture" value="{{$picture["id"]}}">
                                                                    @if(session()->get("isConnected"))
                                                                        @if(!in_array(session()->all()["user"]["id"], $picture["likes"]))
                                                                            <input name="method" value="like" class="d-none">
                                                                            <button type="submit" class="btn btn-outline-success mx-auto my-2">Like ! ({{count($picture["likes"])}})</button>
                                                                        @else
                                                                            <input name="method" value="dislike" class="d-none">
                                                                            <button type="submit" class="btn btn-outline-danger mx-auto my-2">Dislike ! ({{count($picture["likes"])}})</button>
                                                                        @endif
                                                                    @else
                                                                        <button type="button" class="btn btn-outline-secondary mx-auto my-2">Like : ({{count($picture["likes"])}})</button>
                                                                    @endif
                                                                {!!Form::close()!!}
                                                            </div>

                                                            {{-- Comments number --}}
                                                            <button type="button" class="pleins btn btn-link col" data-toggle="collapse" data-target="#collapsePhoto{{$picture["id"]}}" aria-expanded="false" aria-controls="collapsePhoto{{$picture["id"]}}">
                                                                <i class="far fa-comment fa-2x"></i>
                                                                {{count($picture["comments"])}}
                                                            </button>
                                                            <div class="w-100"></div>
                                                        </div>

                                                        {{-- Comments --}}
                                                        <div class="collapse" id="collapsePhoto{{$picture["id"]}}">
                                                            <div class="container-fluid w-100 bg-light border-light border">
                                                                @foreach($picture["comments"] as $comment)
                                                                    {{-- Check if comment isn't banned--}}
                                                                    @if($comment["id_state"] != 2)
                                                                        <article class="comments">
                                                                            {{-- Ban button --}}
                                                                            @if(session("isConnected") && session()->all()["user"]["rankLevel"] >=4)
                                                                                <div class="mx-auto my-2">
                                                                                    {!!Form::open(['url' => 'comments/ban'])!!}
                                                                                    <input name="method" value="ban" class="d-none">
                                                                                    <input class="d-none" name="id_comment" value="{{$comment["id"]}}">
                                                                                    <button type="submit" class="btn btn-outline-danger col">Bannir ce commentaire</button>
                                                                                    {!!Form::close()!!}
                                                                                </div>
                                                                            @endif
                                                                            <p class="souligne">{{$comment["user_name"]}} {{$comment["user_lastname"]}} :</p>
                                                                            <p>{{$comment["comment"]}}</p>
                                                                        </article>
                                                                    @endif
                                                                @endforeach

                                                                @if(session("isConnected"))
                                                                {{-- Comment form --}}
                                                                <div class="cadre">
                                                                    {!!Form::open(['url' => 'event/comment'])!!}
                                                                        <div>
                                                                            <div class=" cadre form-group row">
                                                                                <div class="cadre mx-auto">
                                                                                    <input class="d-none" name="id_picture" value="{{$picture["id"]}}">
                                                                                    <input name="method" value="comment" class="d-none">
                                                                                    <input class="form-control" placeholder="Votre commentaire" name="comment" type="text">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row text-right">
                                                                                <div class="col">
                                                                                    <input class="btn btn-primary" type="submit" value="Commenter">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    {!!Form::close()!!}
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>

                                    @if(session("isConnected"))
                                        {{-- Picture form --}}
                                        <div class="cadre">
                                            {!!Form::open(['url' => 'event/addpicture', 'files' => true])!!}
                                            <div>
                                                <div class="cadre form-group row">
                                                    <div class="cadre mx-auto">
                                                        <input class="d-none" name="id_event" value="{{$event["id"]}}">
                                                        <input name="method" value="add" class="d-none">
                                                        {!! Form::label('image', 'Votre image') !!}
                                                        {!! Form::file('image', null) !!}
                                                    </div>
                                                </div>
                                                <div class="form-group row text-right">
                                                    <div class="col">
                                                        <input class="btn btn-primary" type="submit" value="Ajouter une photo">
                                                    </div>
                                                </div>
                                            </div>
                                            {!!Form::close()!!}
                                        </div>
                                    @endif

                                @endif
                            </div>
                        </div>

                    </div>
                </article>
            </div>
        @endif
    @endforeach
</div>
