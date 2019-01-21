<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=yourdev;charset=utf8', 'yourdev', 'euBcIdjOgmwJDQc9');
        $request = $bdd->prepare('select count(*) from services');
        $request->execute();

        if ($request->fetch()[0] > 0)
        {
            echo '<div class="row my-5" id="services">
                    <h4 class="w-100 text-center my-4">Nos services :</h4>';

            $request->closeCursor();
            $request = $bdd->prepare('select * from services');
            $request->execute();

            while ($result = $request->fetch())
            {
                echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-5" id="'. $result['services_name'] .'">
                        <div class="card border-light">';

                if ($result['services_imageURL'] != null)
                {
                    echo '<img class="card-image-top mx-auto my-3 img-fluid cardImage" src="'. $result['services_imageURL'] .'" alt="generic website logo">';
                }

                echo '<div class="card-body bg-light">
                        <h5 class="card-title">'. $result['services_name'] .'</h5>
                        <h6 class="card-subtitle text-muted">'. $result['services_subname'] .'</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p class="card-text text-muted">'. $result['services_description'] .'</p>
                        </li>
                        <li class="list-group-item bg-light">
                            <p class="card-text">
                                Prix : '. ($result['services_price'] == -1 ? "sur devis" : $result['services_price']) .'<br>Disponibilité : '. $result['services_disponibility'] .'
                            </p>
                            <div class="text-center text-lg-right">
                                <button class="btn btn-outline-info mx-2 my-1">En savoir plus</button>
                                <button class="btn btn-outline-success mx-2 my-1">Commander</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>';

            }
            $request->closeCursor();
            echo '</div>';
        }
    }
    catch (Exception $exception)
    {
        echo $exception;
    }

