<!-- section : Modifier mon profil -->
<div class="tab-pane" id="p2">
    <section id="cover">
        <div id="cover-caption">
            <div id="container">
                <div class="col-sm-10" id="Titre">
                    <h3>Modifiez votre profil</h3>
                    <div class="info-form">

                        {!!Form::open(['url' => 'personnel/update', "class" => "ml-5 m-3", "id" => "modprofil"])!!}
                            <div class="form-group row">
                                <label for="inputCentre" class="col-sm-3 col-form-label">Votre centre CESI :</label>
                                <div class="col-sm-9">
                                    <input name="campus" type="Centre" class="col-sm-3 form-control" id="Centre" placeholder="(Optionnel)">
                                    {!! $errors->first('campus', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-3 col-form-label">Adresse e-mail :</label>
                                <div class="col-sm-9">
                                    <input name="email" type="email" class="col-sm-3 form-control" id="inputEmail" placeholder="(Requise si changement de mot de passe)">
                                    {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword1" class="col-sm-3 col-form-label">Ancien mot de passe
                                    :</label>
                                <div class="col-sm-9">
                                    <input name="old_password" type="password" class="col-sm-3 form-control" id="inputPassword1" placeholder="(Requis si changement de mot de passe)">
                                    {!! $errors->first('old_password', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword2" class="col-sm-3 col-form-label">Nouveau mot de
                                    passe :</label>
                                <div class="col-sm-9">
                                    <input name="new_password" type="password" class="col-sm-3 form-control" id="inputPassword2" placeholder="(Requis si changement de mot de passe)">
                                    {!! $errors->first('new_password', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Confirmez votre
                                    nouveau mot de passe :</label>
                                <div class="col-sm-9">
                                    <input name="verif_password" type="password" class="col-sm-3 form-control" id="inputPassword3" placeholder="(Requis si changement de mot de passe)">
                                    {!! $errors->first('verif_password', '<small class="help-block">:message</small>') !!}
                                </div>
                            </div>
                            <div class="btn-group co-sm-10">
                                <div class="col-auto form-group">
                                    <button type="submit" class="btn btn-primary" id="buttonconf">Confirmer</button>
                                </div>
                                <div class="col-auto form-group">
                                    <a href="/personnel"><button type="button" href="/personnal" class="btn btn-primary" id="buttonannul">Annuler</button></a>

                                </div>
                            </div>
                        {!!Form::close()!!}

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- section : Modifier mon profil -->

{{-- Close account button --}}
<div class="container my-4">
    <div class="row">
        <div class="col">
            <h3>Cloture du compte : </h3>
        </div>
    </div>
    <div class="row my-2">
        <div class="col">
            <a href="/personnel/cloture">
                <button class="btn btn-outline-danger">Cloturer</button>
            </a>
        </div>
    </div>
</div>
