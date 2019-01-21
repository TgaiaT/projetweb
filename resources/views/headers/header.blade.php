<nav class="navbar navbar-expand-md sticky-top navbar-dark" style="background-color: steelblue;" id="navbar">
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