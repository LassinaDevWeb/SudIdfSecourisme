<?php ob_start();
?>


<main>
    <?php if (!empty($_SESSION['prenom'])) {
        // Affichage d'un menu si un utilisateur est connecté 
    ?>
        <a href="create_formation" class="btn btn-outline-primary float-right"><b><i>ajouter une formation</i></b></a>
    <?php }

    ?>
    <h1 class="text-center text-danger ml-5 mt-4"><i><u>Liste des formations</u></i></h1>
    <?php if (!empty($_SESSION['modif'])) { ?>
        <h3 class="text-primary"><b><i><?php echo $_SESSION['modif']; ?></i></b></h3>

    <?php }
    ?>
    <div class="row">
        <?php
        if (!empty($formations)) {
            for ($i = 0; $i < count($formations); $i++) :
        ?>
                <div class="col-md-12 col-lg-12 col-sm-12 mt-12 ml-12 mb-12">
                    <div class="jumbotron mt-3 container " id="jum">
                        <?php if (!empty($_SESSION['prenom'])) {
                            // Affichage d'un menu si un utilisateur est connecté 
                        ?>
                            <button type="submit" class="close" aria-label="Close" data-toggle="modal" data-target="#Modal<?php echo $formations[$i]->getId(); ?>">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        <?php } ?>
                        <div class="modal fade" id="Modal<?php echo $formations[$i]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><b><i>Suppression de la formation <?php echo $formations[$i]->getTitre(); ?></i></b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-danger"><b><i>Etes vous sur de vouloir supprimer la formation <?php echo $formations[$i]->getTitre(); ?> ?</i></b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="suppr_formation" method="post">
                                            <input name="id_jumb_formation" type="hidden" value="<?php echo $formations[$i]->getId(); ?>">
                                            <input type="submit" name="search" value="Supprimer" class="btn btn-outline-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h1 class="display-4 text-left "><u><?php echo $formations[$i]->getTitre(); ?></u></h1>
                        <p class="lead text-center"><?php echo $formations[$i]->getDescription() ?></p>
                        <form class="col-6 col-sm-12 col-md-12" action="formation" method="post">
                            <input name="id_jumb_formation" type="hidden" value="<?php echo $formations[$i]->getId(); ?>">
                            <input type="submit" name="search" value="Descriptif complet de la formation >" class="btn btn-outline-danger">
                        </form>
                    </div>

                </div>
    </div>
<?php
            endfor;
        } elseif (empty($formations)) {
?>
<h2 class=" ml-5 mt-5 text-white bg-dark text-center"><b> Pas encore de formation proposer sur le site !</b></h2>

<?php   } ?>


</main>





<?php
$content = ob_get_clean();
$titre = "liste de Formation";
require "template.view.php";
?>