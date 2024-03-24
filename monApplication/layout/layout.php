<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>CeriCar</title>
</head>

<body>

    <div class="image-container">
        <img src="https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/images/2.jpeg" style="width: 100%;height: 400px;">
        <div class="overlay-text">
            <h1>CeriCar</h1>
        </div>
    </div>

    <?php if ($context->getSessionAttribute('user_id')): ?>
        <?php echo $context->getSessionAttribute('user_id') . " est connecté"; ?>
    <?php endif; ?>

    <div id="page">
        <?php if ($context->error): ?>
            <div id="flash_error" class="error">
                <?php echo " $context->error !!!!!" ?>
            </div>
        <?php endif; ?>

        <?php if ($context->notification): ?>
            <div id="flash_notification" class="notification">
                <?php echo $context->notification; ?>
            </div>
        <?php endif; ?>
        <br>
        <span id="bandeau"><?php echo "Bienvenue sur CeriCar"?></span>
        <br>
        <br>
        <div id="page_maincontent">
            <?php include($template_view); ?>
        </div>
    </div>

    <footer>
        <p>Rejoignez-nous sur :</p>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-facebook"></i>
    </footer>

    <script src="https://pedago.univ-avignon.fr/~uapv2200060/CeriCarProjet/squelette_L3/js/ajax.js"></script>
</body>

</html>
