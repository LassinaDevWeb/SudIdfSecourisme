<?php ob_start(); ?>
<header>




    <section class="wrapper_calendrier">
        <h1 class="text-center text-danger mt-4"><i><u>Calendrier des formations</u></i></h1>
        <br>

        <?php

        if (!empty($list_formations)) {

            for ($a = 0; $a < count($list_formations); $a++) :

        ?>
                <h3 class="text-danger"><b><i><u>Formation <?php echo $list_formations[$a]->getTitre(); ?></u></i></b></h3>
                <?php if (!empty($instancier)) {
                    for ($b = 0; $b < count($instancier); $b++) :
                        if ($list_formations[$a]->getId() == $instancier[$b]->getId_forma()) {
                            $date = $instancier[$b]->getFormation_date();

                ?>
                            <h5> <b><i>• <?php echo implode('/', array_reverse(explode('-', $date)));  ?> </i></b></h5>
                            <br>
                    <?php
                        }

                    endfor;
                } elseif (empty($instancier)) {
                    ?>
                    <h2> Pas encore de date pour cette formation</h2>
                <?php
                }
                ?>

                <?php if (!empty($_SESSION['prenom'])) {
                    // Affichage d'un menu si un utilisateur est connecté 
                ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?php echo $list_formations[$a]->getId(); ?>">
                        Ajouter/supprimer
                    </button>
                <?php } ?>
                <div class="modal fade" id="Modal<?php echo $list_formations[$a]->getId(); ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel<?php echo $list_formations[$a]->getId(); ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header_modal">
                                <h5 class="modal-title" id="ModalLabel<?php echo $list_formations[$a]->getId(); ?>">Calendrier de la Formation <?php echo $list_formations[$a]->getTitre(); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4 class="text-left text-danger"><b><u> Supprimer date </u></b></h4>
                                <?php if (!empty($instancier)) {
                                    for ($c = 0; $c < count($instancier); $c++) :
                                        if ($list_formations[$a]->getId() == $instancier[$c]->getId_forma()) {
                                            $date = $instancier[$c]->getFormation_date();

                                ?>
                                            <h5> <b><i>• <?php echo implode('/', array_reverse(explode('-', $date)));  ?> </i></b></h5>
                                            <form action="supprimer_date" method="POST">
                                                <input id="id_formation" name="id_formation" type="hidden" value="<?php echo $list_formations[$a]->getId(); ?>">
                                                <input id="id_calendrier" name="id_calendrier" type="hidden" value="<?php echo $instancier[$c]->getId_calend(); ?>">
                                                <input type="submit" name="search" value="Supprimer" class="btn btn-outline-danger">
                                            </form>
                                            <br>


                                        <?php
                                        } else {
                                        ?>
                                            <h2> Pas encore de date pour cette formation</h2>
                                    <?php
                                        }
                                    endfor;
                                } elseif (empty($instancier)) {
                                    ?>
                                    <h2> Pas encore de date de pour toute les formations !</h2>
                                <?php } ?>
                                <hr>
                                <h4 class="text-left text-danger"><b><u> Ajouter date </u></b></h4>
                                <form action="ajouter_date" method="POST">
                                    <input id="id_formation" name="id_formation" type="hidden" value="<?php echo $list_formations[$a]->getId(); ?>">
                                    <input id="date" name="date" type="date">
                                    <input type="submit" value="ajouter" class="btn btn-outline-primary">
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
                <hr class="mx-5">
            <?php endfor;
        } elseif (empty($list_formations)) {
            ?>
            <h2> Pas encore de Formation sur le site pour avoir des dates</h2>
        <?php } ?>


    </section>





    <?php
    $content = ob_get_clean();
    $titre = "Calendrier";
    require "template.view.php";
    ?>