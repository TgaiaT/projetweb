@php 
    session_start();
@endphp

<header>

    {{-- Premiere nav-barre la barre bleu qui reste tout en haut de l'écran--}}
    <nav class="navbar navbar-expand-md sticky-top navbar-dark headNav" id="first-head">
        <ul class="navbar-nav ml-auto">
            <li class="navbar-item" id="user-name">
                @php
                    /*Affichage du nom et prenom si connecté sinon affiche le lien vers la connection*/
                    if (isset($_SESSION['userloged']) && isset($_SESSION['user_name']) && isset($_SESSION['user_last-name']) && $_SESSION['userloged'] == true)
                    {
                        echo '<a href="http://localhost/projetweb/server.php/personnel" class="nav-link">'. $_SESSION['user_name'] . $_SESSION['user_last-name'].'   <i class="far fa-user"></i></a>';
                        echo '<a href="http://localhost/projetweb/server.php/deconnexion" class="nav-link">Déconnexion</a>';
                    } else {
                        echo '<a href="http://localhost/projetweb/server.php/connexion" class="nav-link">Connexion   <i class="far fa-user"></i></a>';
                    }
                @endphp
            </li>
            <li class="navbar-item" id="user-panier">
                @php
                    /*Affichage du pannier si l'uttilisateur est connecté*/
                    if (isset($_SESSION['userloged']) && isset($_SESSION['user_pseudo']) && $_SESSION['userloged']){
                        /*Si l'uttilisateur a deja un pannier on le reprend sinon on lui dit qu'il est vide*/
                        if(isset($_COOKIE['panier'])){
                            echo '<a href="http://localhost/projetweb/server.php/panier" class="nav-link">Pannier:'.$_COOKIE['panier'].' €   <i class="fas fa-shopping-basket"></i></a>';
                        } else {
                            echo '<a href="http://localhost/projetweb/server.php/panier" class="nav-link">Panier: 00.00 €   <i class="fas fa-shopping-basket"></i></a>';
                        }
                    } else {
                        echo '<a href="http://localhost/projetweb/server.php/panier" class="nav-link">Panier:  00.00 €   <i class="fas fa-shopping-basket"></i></a>';
                    }
                 @endphp
            </li>
        </ul>
    </nav>

    {{-- Deuxieme barre du header qui n'affiche que le logo. cliquer sur le logo mene a la page d'index --}}
    <div class="headLogo" id="second-head">
        <a href="http://localhost/projetweb/server.php/"><img id="logo" src="http://localhost/projetweb/resources/assets/Images/logo.png" alt="logo"></a>
    </div>

    {{-- Troisieme et derniere barre du header bleu elle aussi elle contient un menu dérroullant menant aux différentes section du sites. Si l'écran est grand alors on cache le menu dérroullant. ca se passe dans script.js--}}
    <nav class="navbar navbar-expand-md navbar-dark headNav row" id="third-head">
        <ul class="navbar-nav" id="menu">
            <button type="button" class="btn btn-dark" id="buttonMenu"><i class="fas fa-bars fa-2x" id="menuTop"></i></button>
            <li class="navbar-item submenu">
                <a href="http://localhost/projetweb/server.php/event" class="nav-link"><i class="fas fa-users"></i>   EVENEMENTS</a>
            </li>
            <li class="navbar-item submenu">
                <a href="http://localhost/projetweb/server.php/event" class="nav-link"><i class="far fa-lightbulb"></i>   BOITE A IDEES</a>
            </li>
            <li class="navbar-item submenu">
                <a href="http://localhost/projetweb/server.php/event" class="nav-link"><i class="fas fa-shopping-cart"></i>   BOUTIQUE</a>
            </li>
            <li class="navbar-item submenu">
                <a href="http://localhost/projetweb/server.php/event" class="nav-link"><i class="far fa-envelope-open"></i>   CONTACT</a>
            </li>
        </ul>
    </nav>
</header>
