<header>
    {{-- Premiere nav-barre la barre bleu qui reste tout en haut de l'écran--}}
    <nav class="navbar navbar-expand-md sticky-top navbar-dark headNav" id="first-head">
        <ul class="navbar-nav ml-auto">
            <li class="navbar-item" id="user-name">
                @php
                    /*Affichage du nom et prenom si connecté sinon affiche le lien vers la connection*/
                    if (session()->get("isConnected"))
                    {
                        echo '<a href="/personnel" class="nav-link">'. session()->all()["user"]["name"] ." ". session()->all()["user"]["lastname"] .'   <i class="far fa-user"></i></a>';
                        echo '<a href="/deconnexion" class="nav-link">Déconnexion</a>';
                    } else {
                        echo '<a href="/connexion" class="nav-link">Connexion   <i class="far fa-user"></i></a>';
                    }
                @endphp
            </li>
            {{-- Basket --}}
            <li class="navbar-item" id="user-panier">
                @if (session()->get("isConnected"))
                    @if(isset(session()->get("basket")[0]))
                        <a href="/panier" class="nav-link">Pannier: {{session()->get("basketValue")}}€<i class="fas fa-shopping-basket"></i></a>
                    @else
                        <a href="/panier" class="nav-link">Panier: 00.00 €<i class="fas fa-shopping-basket"></i></a>
                    @endif
                @endif
            </li>
        </ul>
    </nav>

    {{-- Deuxieme barre du header qui n'affiche que le logo. cliquer sur le logo mene a la page d'index --}}
    <div class="headLogo" id="second-head">
        <a href="/"><img id="logo" class="nonClickable" src="/images/Logo.png" alt="logo"></a>
    </div>

    {{-- Troisieme et derniere barre du header bleu elle aussi elle contient un menu dérroullant menant aux différentes section du sites. Si l'écran est grand alors on cache le menu dérroullant. ca se passe dans script.js--}}
    <nav class="navbar navbar-expand-md navbar-dark headNav row" id="third-head">
        <ul class="navbar-nav" id="menu">
            <button type="button" class="btn btn-dark" id="buttonMenu"><i class="fas fa-bars fa-2x" id="menuTop"></i></button>
            <li class="navbar-item submenu">
                <a href="/event" class="nav-link"><i class="fas fa-users"></i>   EVENEMENTS</a>
            </li>
            <li class="navbar-item submenu">
                <a href="/idees" class="nav-link"><i class="far fa-lightbulb"></i>   BOITE A IDEES</a>
            </li>
            <li class="navbar-item submenu">
                <a href="/boutique" class="nav-link"><i class="fas fa-shopping-cart"></i>   BOUTIQUE</a>
            </li>
            <li class="navbar-item submenu">
                <a href="/contact" class="nav-link"><i class="far fa-envelope-open"></i>   CONTACT</a>
            </li>
        </ul>
    </nav>
    <div id="myModal" class="modal">
        <img class="modal-content" id="img01">
        <div id="caption"></div>
        <span class="close">&times;</span>
    </div>
    <div id="scrollUp">
        <i class="fas fa-angle-double-up fa-5x"></i>
    </div>
</header>
