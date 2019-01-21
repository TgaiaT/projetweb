<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dév à la carte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="src/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include ('headers/header.php');
        if (isset($_SESSION['userloged']) && $_SESSION['userloged'] == true)
        {
            session_unset();
            session_destroy();
            include ('old_components/valid_deconnexion.php');
            header('Status: 301 Moved Permanently', false, 301);
            header('refresh:1;url=/');
            exit();
        }
        else
        {
            include ('old_components/invalid_deconnexion.php');
        }
    ?>

    <div class="fixed-bottom">
        <?php
        include ('footers/footer.php');
        ?>
    </div>
</body>
</html>