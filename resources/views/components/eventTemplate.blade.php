<div id="memories">
  <div class="conteneur">
    {{-- Surrement a rediviser en include pour les boucle PHP --}}

    <article> {{-- Ce premier article représente un event --}}
      <div class="cadre">
        <div class="row">
          <h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">Nom du dernier évenement passé</h5>
          <p class="date col-sm-5 col-md-5 col-lg-5 col-xl-5"> 03/24/2019 </p>  
          <div class="cadre col-sm-12 col-md-6 col-lg-4 col-xl-4">
    				<img src="./images/bde.jpg" alt="imageEvent" class="img-fluid">
				  </div>

          <div class="col-sm-12 col-md-5 col-lg-8 col-xl-8">
            <p class="descriptionEvent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi.</p>
            <p class="lieu"> Epinal</p>
            <p class="prix"> 24.56 €</p>
          </div>
          <div class="w-100"></div>
        </div>

        <div class="cadre"> {{-- boutton du premier collapse "en savoir plus" --}}
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
            {{--@php
              /* Si c'est un event a venir allors echo "Au programme:" Si c'est un souvenirs alors echo "Voir les posts" */
            @endphp--}}
            En savoir plus
          </button>
        </div>
        <div class="collapse" id="collapse">
          <div class="card conteneur card-body"> {{-- ici on met ce que contient le collapse. deux possibilités: --}}

            {{--A RECREER EN BOUCLE EN PHP --}}

              {{-- CAS 1 : évenement a venir             juste un liste a faire en foreach contenant un bouton reste a faire la reponse du bouton en JS ou PHP--}}

                <ul class="cadre row">
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="cadre">
                      <p class="pleins col-sm-12 col-md-7 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="pleins btn btn-secondary col-sm-4 col-md-2 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="cadre ">
                      <p class="col-sm-12 col-md-10 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="btn btn-secondary col-sm-4 col-md-3 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="cadre ">
                      <p class="col-sm-12 col-md-10 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="btn btn-secondary col-sm-4 col-md-3 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                <ul>

              {{-- CAS 2 : event passé             une boucle en php va généré un article pour chaque photo--}}
                <!-- <div>
                  <form method="POST" action="{{-- A RENTREZ ICI --}}" accept-charset="UTF-8"><input name="_token" type="hidden" value="{{-- bpQ7vlXxenwdnr6YPpzYYs1C97Lbw2ii53U9Xk77h --}}">
                    <div class="cadre">
                      <div class="main form-group row cadre">
                        <label for="email" class="formPlace col-sm-10 col-md-4 col-lg-3 col-xl-3 col-form-label">Poster une photo: </label>
                        <input class="formPlace form-control col-sm-10 col-md-5 col-lg-7 col-xl-7" placeholder="Lien de la photo" name="imgUrl" type="link" id="imgUrl"> 
                        <input class="formPlace btn btn-primary col-sm-10 col-md-2 col-lg-1 col-xl-1" type="submit" value="Poster">
                        <div class="w-100"></div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="row cadre">
                  <div class="cadre col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <article> {{-- cette article est pour une photo postée --}}
                      <div class="cadre col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <img src="./images/bde.jpg" alt="imageEvent" class="img-fluid">
                      </div>
                      <div class="pleins col-sm-12 col-md-12 col-lg-12 col-xl-12 row">
                        <div class="main col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          @php /*Chaque photo peux etre liker par un uttilisateur*/
                            /*
                              if(a déja liker){
                                echo '<a href="le lien du dislike"><i class="far fa-heart fa-2x"></i></a>';
                              } else {
                                echo '<a href="le lien du like"><i class="fas fa-heart fa-2x"></i></a>';
                              }

                              echo le nombre de like de la photo;
                            */
                          @endphp
                          <a href=""><i class="far fa-heart fa-2x"></i></a> XXX
                        </div>
                        <button type="button" class="pleins btn btn-link col-sm-6 col-md-6 col-lg-6 col-xl-6" data-toggle="collapse" data-target="#collapsePhoto1{{-- id --}}" aria-expanded="false" aria-controls="collapsePhoto1{{-- id --}}">
                          <i class="far fa-comment fa-2x"></i>
                          @php
                            /*echo le nombre de commentaires*/
                          @endphp
                          XXX
                        </button>
                        <div class="w-100"></div>
                      </div>
                        {{-- ________________collapse comments exemple:_______________ --}}
                          <div class="collapse" id="collapsePhoto1{{-- id --}}">
                            <div class="card conteneur card-body"

                              <article class="comments">
                                <p class="souligne">
                                  NOM DU GUGUS QUI COMMENTE :
                                </p>
                                <p>
                                  ceci est un super commentaire sous une super photo!
                                </p>
                              </article>

                              <article class="comments">
                                <p class="souligne">
                                  hater lambda :
                                </p>
                                <p>
                                  Moi je l'aime pas du tout! FDP delete ca tt de suite!
                                </p>
                              </article>

                              <article class="comments">
                                <p class="souligne">
                                  Censeur du Cesi :
                                </p>
                                <p>
                                  Votre demande de rendez-vous avec le directeur régional a été prise en compte monsieur Hater Lambda. Mardi 13h50. Cordialement.
                                </p>
                              </article>

                              <article class="comments">
                                <p class="souligne">
                                  Camarade de projet :
                                </p>
                                <p>
                                  R.E.K.T. x'D
                                </p>
                              </article>

                              {{-- Poster un commenataire --}}
                              <div class="cadre">
                                <form method="POST" action="{{-- A RENTREZ ICI --}}" accept-charset="UTF-8"><input name="_token" type="hidden" value="{{-- bpQ7vlXxenwdnr6YPpzYY1C97Lbw2ii53U9Xk77h --}}">
                                  <div>
                                    <div class=" cadre form-group row ">
                                      <div class="cadre">
                                        <input class="form-control" placeholder="Votre commentaire" name="comments" type="text" id="comments1{{-- id --}}"> 
                                      </div>
                                    </div>
                                    <div class="form-group row text-right">
                                      <div class="col">
                                        <input class="btn btn-primary" type="submit" value="Commenter">
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                            
                        {{-- ___________fin collapse comments______________ --}}

                    </article>
                  </div>
                    -->
                </div>
          </div>
        </div>
      </div>
    </article>

  </div>
</div>