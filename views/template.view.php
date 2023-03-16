<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/css.css">
    <title><?= $title ?></title>
</head>


<body class="wrapper_page">


    <header>

        <nav class="head-of-nav navbar navbar-expand-lg " id="navbar">

            <a href="accueil"><img src="../public/images/logo/logo.jpg" alt="Sud îls de France secourisme" class="rounded float-left" style="width: 80px;"></a>
            <h1 class="logo text-light"><i>Sud Ile-de-France Secourisme</i></h1>
            <?php if (!empty($_SESSION['prenom'])) {
                // Affichage d'un menu si un utilisateur est connecté 
            ?>

                <div class="dropdown dropleft ">
                    <a href="#" class="dropdown-toggle btn btn-link lien_nav  " data-toggle="dropdown" class="Text"><?php echo $_SESSION['prenom']; ?></a>
                    <ul class="dropdown-menu" role="menu">
                        <div class="container col-sm-12" style="padding: 5px;">

                            <form action="deconnexion" method="POST">
                                <input type="submit" name="btnDeco" value="Se deconnecter" class="btn btn-outline-danger">
                            </form>

                            <a href="boite_message" class="btn btn-outline-primary">Reception Message</a>
                        </div>
                    </ul>
                </div>
            <?php
            } else {
            ?>



                <div class="dropdown dropleft conexion_hidden_phone">
                    <a href="#" class="dropdown-toggle btn liste_nav lien_nav" data-toggle="dropdown" class="Text">Connexion</a>
                    <ul class="dropdown-menu" role="menu">
                        <div class="container col-sm-12" style="padding: 5px;">

                            <form method="POST" action="connexion" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="text-danger" for="indentifiant">Indentifiant:</label>
                                    <input type="text" class="form-control input" id="identifiant" placeholder="Entrer votre identifiant" name="identifiant" style="text-align : center;" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-danger" for="password">Mot de passe:</label>
                                    <input type="password" class="form-control input" id="password" placeholder="Enter votre mot de passe" name="password" style="text-align : center;" required>
                                </div>
                                <button type="submit" class="btn btn-dark">Connexion</button>
                            </form>
                            <?php if (!empty($_SESSION['no_admin'])) {
                                // Affichage d'un menu si un utilisateur est connecté 
                            ?>

                                <p class="text-center text-danger"><?php echo $_SESSION['no_admin'] ?></p>


                            <?php } ?>
                        </div>
                    </ul>
                </div>

                <div class="pos-f-t hamburger_affichage">
                    <div class=" dropleft">
                        <a href="#" class="dropdown-toggle btn btn-outline-danger lien_nav button_hamburger taille_icon" data-toggle="dropdown">
                            <span class="bi bi-list taille_icon"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <div class="container affichage_colonne" style="padding: 5px;">
                                <a href="accueil">Accueil</a>
                                <a href="list_formation">Formation</a>
                                <a href="calendrier">Calendrier</a>

                            </div>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>

        </nav>

        <nav class=" navbar-expand-lg" id="item">
            <div class="container_nav">
                <h2>Sud idf secourisme</h2>
                <div class=" item-container">
                    <div class="col-item">
                        <a href="accueil" class="btn lien_nav liste_nav " class="Text"> <b><i>Accueil</i></b></a>
                    </div>
                    <div class="col-item dropdown-formation text-center">
                        <a href="list_formation" class="btn liste_nav lien_nav drop-btn" class="Text"><i>Formation</i></a>
                        <div class="dropdown-contentte ">
                            <?php
                            if (!empty($list_formations)) {
                                for ($i = 0; $i < count($list_formations); $i++) :
                            ?>
                                    <form action="formation" method="post">
                                        <input name="id_jumb_formation" type="hidden" value="<?php echo $list_formations[$i]->getId(); ?>">
                                        <input type="submit" name="search" value="<?php echo $list_formations[$i]->getTitre(); ?>" class="btn liste_nav lien_nav">
                                    </form>
                                <?php
                                endfor;
                            } elseif (empty($list_formations)) {
                                ?>
                                <h3>Aucune formation</h3>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-item">
                        <a href="calendrier" class="btn liste_nav lien_nav  " class="Text"><i>Calendrier</i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="contenue_page">
        <?= $content ?>
    </main>

    <footer>
        <div class="contenue_footer social">
            <ul class="ul_liste_social">
                <li class="footer_li"> <a href="https://www.instagram.com/sud_idf_secourisme/">Instagram</a> </li>
                <li class="footer_li "><a href="https://www.facebook.com/Sud-Ile-de-France-Secourisme-FNMNS-94-558623694192007/">Facebook</a></li>
                <li class="footer_li"><a href="contact">Contact</a></li>
                <!-- <li class="footer_li"><a href="information">Informations</a></li> -->
            </ul>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v13.0" nonce="io1XcJIR"></script>
</body>

</html>