<div id="memories">
  <div class="conteneur">

    <article>
      <div class="cadre">
        <div class="row">
          <h5 class="titre col-sm-5 col-md-5 col-lg-5 col-xl-5">Nom du dernier évenement passé</h5>
          <p class="date col-sm-5 col-md-5 col-lg-5 col-xl-5"> 03/24/2019 </p>  
          <img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-6 col-lg-4 col-xl-4">

          <div class="col-sm-12 col-md-5 col-lg-8 col-xl-8">
            <p class="descriptionEvent">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi.</p>
            <p class="lieu"> Epinal</p>
            <p class="prix"> 24.56</p>
          </div>
          <div class="w-100"></div>
        </div>

        <div class="cadre">
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
            {{--@php
              /* Si c'est un event a venir allors echo "Au programme:" Si c'est un souvenirs alors echo "Voir les posts" */
            @endphp--}}
            En savoir plus
          </button>
        </div>
        <div class="collapse" id="collapse">
          <div class="card card-body">
            {{--A RECREER EN BOUCLE EN PHP --}}

              {{-- CAS 1 : évenement a venir --}}
                {{-- <ul>
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="row">
                      <p class="col-sm-8 col-md-8 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="btn btn-secondary col-sm-2 col-md-2 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="row">
                      <p class="col-sm-8 col-md-8 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="btn btn-secondary col-sm-2 col-md-2 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                  <li>
                    <p class="souligne">Titre de l'activité :</p>
                    <div class="row">
                      <p class="col-sm-8 col-md-8 col-lg-8 col-xl-8">Description de l'activité blabla bla blablabla blabla bla blablabla blabla bla blablabla blabla bla blablabla </p>
                      <button type="button" class="btn btn-secondary col-sm-2 col-md-2 col-lg-2 col-xl-2">S'inscrire</button>
                    </div>
                  </li>
                <ul> --}}

              {{-- CAS 2 : event passé --}}
                <div class="row">

                  <article class="cadrePleins col-sm-12 col-md-5 col-lg-5 col-xl-3">
                    <img src="http://localhost/projetweb/resources/assets/Images/bde.jpg" alt="imageEvent" class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 row">
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        @php
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
                      <button type="button" class="btn btn-link col-sm-6 col-md-6 col-lg-6 col-xl-6" data-toggle="collapse" data-target="#collapsePhoto" aria-expanded="false" aria-controls="collapsePhoto">
                        <a href="{{-- le lien pour commenter --}}"><i class="far fa-comment fa-2x"></i></a>
                        @php
                          /*echo le nombre de commentaires*/
                        @endphp
                        XXX
                      </button>
                    </div>
                    <div class="collapse" id="collapsePhoto">
                      <div class="card card-body">
                        
                      </div>
                    </div>
                  </article>


                </div>
          </div>
        </div>
      </div>
    </article>

  </div>
</div>