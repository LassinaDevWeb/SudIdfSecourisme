<?php ob_start(); ?>



<div class="wrapper">
    <div class="texte_div">
        <?php
        for ($d = 0; $d < count($information); $d++) :
        ?>
            <h1 class="text_acueill">

                <?php echo $information[$d]->getInformation(); ?>


            </h1>
            <?php if (!empty($_SESSION['prenom'])) {
                // Affichage d'un menu si un utilisateur est connecté 
            ?>
                <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#Modal2">
                    Modifier
                </button>
                <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="exampleModalLabel">Modifier information</h5>
                            </div>
                            <div class="modal-body">
                                <form action="modif_information" method="POST">
                                    <input id="id_admin" name="id_admin" type="hidden" value=" <?php echo $information[$d]->getId(); ?>">
                                    <label class="text-danger font-weight-bold font-italic" for="tarif">Information accueil :</label>
                                    <textarea name="information" class="form-control" id="information" maxlength="2042" wrap cols="30" rows="10"> <?php echo $information[$d]->getInformation(); ?></textarea>
                                    <input type="submit" name="modif" value="Modifier" class="btn btn-outline-primary ml-0 mt-3">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php
        endfor
        ?>
    </div>
    <section class="image_defilante">
        <div id="carouselIndicators" class="carousel slide width_image" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                if (!empty($annonce)) {
                    for ($b = 0; $b < count($annonce); $b++) :
                ?>
                        <li data-target="#carouselIndicators" data-slide-to="<?php echo $annonce[$b]->getId(); ?>-<?php echo $annonce[$b]->getNom(); ?>"></li>
                <?php
                    endfor;
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 img-fluid rounded img" src="../public/images/intro_principal.jpg" alt="First slide">
                </div>
                <?php
                if (!empty($annonce)) {
                    for ($a = 0; $a < count($annonce); $a++) :
                ?>
                        <div class="carousel-item">
                            <img class="d-block w-100 img-fluid rounded img" src="../public/images/<?php echo $annonce[$a]->getId(); ?>-<?php echo $annonce[$a]->getImage(); ?>" alt="<?php echo $annonce[$a]->getNom(); ?> slide">
                        </div>
                <?php
                    endfor;
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <?php if (!empty($_SESSION['prenom'])) {
            // Affichage d'un menu si un utilisateur est connecté 
        ?>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#Modal">
                Ajouter/supprimer
            </button>
        <?php } ?>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header header_modal">
                        <h5 class="modal-title" id="ModalLabel">Images d'annonce</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-left text-danger"><b><u> Supprimer Annonce </u></b></h4>

                        <?php
                        if (!empty($annonce)) {
                            for ($c = 0; $c < count($annonce); $c++) :


                        ?>
                                <img src="../public/images/<?php echo $annonce[$c]->getId(); ?>-<?php echo $annonce[$c]->getImage(); ?>" alt="<?php echo $annonce[$c]->getNom(); ?>" class="petit_img float-right">
                                <h5> <b><i>•<?php echo $annonce[$c]->getNom(); ?> </i></b></h5>
                                <form action="supprimer_annonce" method="POST">
                                    <input id="id_annonce" name="id_annonce" type="hidden" value="<?php echo $annonce[$c]->getId(); ?>">
                                    <input type="submit" name="search" value="Supprimer" class="btn btn-outline-danger">
                                </form>
                                <br>


                            <?php

                            endfor;
                        } else {
                            ?>

                            <h3>Aucune Annonce à supprimer</h3>


                        <?php
                        }
                        ?>

                        <hr>
                        <h4 class="text-left text-danger"><b><u> Ajouter Image Annonce </u></b></h4>
                        <br>
                        <form action="ajouter_annonce" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-6">
                                <label for="titre">Titre de l'image</label>
                                <input type="text" name="nom" class="form-control " id="nom" placeholder="Titre" required>
                            </div>
                            <div class="form-group col-6 mt-3">

                                <input type="file" class="custom-file-input input" name="image" id="image">
                                <label class="custom-file-label" for="image">Choisir une images</label>
                            </div>
                            <input type="submit" value="ajouter" class="btn btn-outline-primary">
                        </form>


                    </div>

                </div>
            </div>
        </div>


    </section>



</div>
<?php if (!empty($_SESSION['image_oversize'])) {
    // Affichage d'un menu si un utilisateur est connecté 
?>
    <p class="text-center text-danger h1"><?php echo $_SESSION['image_oversize'] ?></p>


<?php } ?>


<?php
$content = ob_get_clean();
$titre = "Accueil";
require "template.view.php";
?>