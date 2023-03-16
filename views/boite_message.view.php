<?php ob_start(); ?>



<h1 class="text-center text-danger mt-4"><i><u>Liste des messages</u></i></h1>
<div class="row">
    <?php
    if (!empty($message)) {
        for ($i = 0; $i < count($message); $i++) :
    ?>
            <div class="col-md-12 col-lg-12 col-sm-12 mt-12 ml-12 mb-12">
                <div class="jumbotron mt-3 container " id="jum">

                    <button type="submit" class="close" aria-label="Close" data-toggle="modal" data-target="#Modal<?php echo $message[$i]->getId();  ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="modal fade" id="Modal<?php echo $message[$i]->getId();  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><b><i>Suppression du message de <?php echo $message[$i]->getNom(); ?>
                                                <?php echo $message[$i]->getPrenom();  ?></i></b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger"><b><i>Etes vous sur de vouloir supprimer le message de <?php echo $message[$i]->getNom(); ?>
                                                <?php echo $message[$i]->getPrenom();   ?> ?</i></b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="suppr_message" method="post">
                                        <input name="id_jumb_message" type="hidden" value="<?php echo $message[$i]->getId(); ?>">
                                        <input type="submit" name="search" value="Supprimer" class="btn btn-outline-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="display-4 text-left "><u><?php echo $message[$i]->getNom(); ?></u></h1>
                    <h2 class="display-6 text-left "><u><?php echo $message[$i]->getPrenom(); ?></u></h2>
                    <h4 class="text-left "><u><?php echo $message[$i]->getNumero(); ?></u></h>
                        <p class="lead text-center"><?php echo $message[$i]->getMessage();  ?></p>


                        <a href="mailto:<?php echo $message[$i]->getEmail(); ?>?subject=SudIDFSecourisme" class="btn btn-outline-primary col-6 col-sm-12 col-md-12">Cliquez ici pour envoyer un e-mail !</a>
                </div>

            </div>
</div>
<?php
        endfor;
    } elseif (empty($message)) {
?>
<h2 class="font-weight-bold"> Messagerie vide !</h2>
<?php
    }
?>
</div>


<?php
$content = ob_get_clean();
$titre = "Messagerie";
require "template.view.php";
?>