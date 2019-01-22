@php 
    session_start();
@endphp

<!DOCTYPE html>
<html>
    <body>
        <header>
            <nav class="navbar navbar-expand-md sticky-top navbar-dark headNav" id="first-head">
                <ul class="navbar-nav ml-auto">
                    <li class="navbar-item" id="user-name">
                        @php
                            if (isset($_SESSION['userloged']) && isset($_SESSION['user_name']) && isset($_SESSION['user_last-name']) && $_SESSION['userloged'] == true)
                            {
                                echo '<a href="../../personnel" class="nav-link">'. $_SESSION['user_name'] . $_SESSION['user_last-name'].' <i class="far fa-user"></i></a>';
                                echo '<a href="../../deconnexion" class="nav-link">Déconnexion</a>';
                            } else {
                                echo '<a href="../../connexion" class="nav-link">Connexion<i class="far fa-user"></i></a>';
                            }
                        @endphp
                    </li>
                    <li class="navbar-item" id="user-panier">
                        @php
                            if (isset($_SESSION['userloged']) && isset($_SESSION['user_pseudo']) && $_SESSION['userloged']){
                                if(isset($_COOKIE['panier'])){
                                    echo '<a href="../../panier" class="nav-link">Pannier:'.$_COOKIE['panier'].' €</a>';
                                } else {
                                    echo '<a href="../../panier" class="nav-link">Panier: 00.00 €</a>';
                                }
                            } else {
                                echo '<a href="../../panier" class="nav-link">Panier:  00.00 € <i class="fas fa-shopping-basket"></i></a>';
                            }
                        @endphp
                    </li>
                </ul>
            </nav>
            <div class="headLogo" id="second-head">
                <a href="../../home"><img id="logo" src="resources/assets/Images/logo.png" alt="logo"></a>
            </div>

            <nav class="navbar navbar-expand-md navbar-dark headNav row" id="third-head">
                <ul class="navbar-nav" id="menu">
                    <button type="button" class="btn btn-dark" id="buttonMenu"><i class="fas fa-bars fa-3x" id="menuTop"></i></button>
                    <li class="navbar-item submenu">
                        <a href="../../event" class="nav-link"><i class="fas fa-users"></i>EVENEMENTS</a>
                    </li>
                    <li class="navbar-item submenu">
                        <a href="../../event" class="nav-link"><i class="far fa-lightbulb"></i>BOITE A IDEES</a>
                    </li>
                    <li class="navbar-item submenu">
                        <a href="../../event" class="nav-link"><i class="fas fa-shopping-cart"></i>BOUTIQUE</a>
                    </li>
                    <li class="navbar-item submenu">
                        <a href="../../event" class="nav-link"><i class="far fa-envelope-open"></i>CONTACT</a>
                    </li>
                </ul>
            </nav>

        </header>
    </body>
</html>






{{--<nav class="navbar navbar-expand-md sticky-top navbar-dark" style="background-color: steelblue;" id="navbar">
    <a class="navbar-brand h1 mb-0" href="../../index.php">
        <img src="images/logo.png" width="30" height="30" alt="logo">
        BDE EXIA NANCY
    </a>
    <button id="navbarTogler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbartab" aria-controls="#navbartab" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mr-auto" id="navbartab">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="../../index.php#aboutUs">
                    Boutique 
                </a>
            </li>
            <li class="navbar-item">
                <a class="nav-link" href="../../index.php#services">
                    Events
                </a>
            </li>
            <li class="navbar-item">
                <a class="nav-link" href="../../index.php#contact">
                    Perso
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="navbar-item">

                @php
                    session_start();

                    if (isset($_SESSION['userloged']) && isset($_SESSION['user_pseudo']) && $_SESSION['userloged'] == true)
                    {
                        echo '<span class="navbar-text mr-2">Bonjour '. $_SESSION['user_pseudo'] .' !</span></li><li class="navbar-item">';
                        echo '<a href="../../deconnexion" class="nav-link">Déconnexion</a>';
                    }
                    else
                    {
                        echo '<a href="../../connexion" class="nav-link">Connexion</a>';
                    }
                @endphp
            </li>
        </ul>
    </div>
</nav>
--}}