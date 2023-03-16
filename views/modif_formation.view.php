<?php ob_start();
?>




<section>
    <div>
        <form action="verif_modif_formation" method="POST" enctype="multipart/form-data">
            <h1 class="text-primary mt-5 ml-5"><i><b>Formation <?php echo $formations->getTitre(); ?> </b></i></h1>
            <hr class="mx-5">
            <h2 class="text-danger"><b>Description</b></h2>
            <br> <textarea name="description" class="form-control" id="description" maxlength="1024" wrap cols="30" rows="10"><?php echo $formations->getDescription(); ?></textarea>
            <br>
            <h2 class="text-danger"><b><?php echo $formations->getTitre(); ?> : qu’est-ce qui change ?</b></h2>
            <br> <textarea name="changement" class="form-control" id="changement" maxlength="1024" wrap cols="30" rows="10"><?php echo $formations->getChangement(); ?></textarea>
            <h2 class="text-danger"><b>A qui est destinée cette formation ?</b></h2>
            <textarea name="destinee" class="form-control" id="destinee" maxlength="512" wrap cols="30" rows="10"><?php echo $formations->getDestinee(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Quel est l’objectif de cette formation ?</b></h2>
            <textarea name="objectif" class="form-control" id="objectif" maxlength="1024" wrap cols="30" rows="10"><?php echo $formations->getObjectif(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Quel est le programme ?</b></h2>
            <textarea name="programme" class="form-control" id="programme" maxlength="4096" wrap cols="30" rows="10"><?php echo $formations->getProgramme(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Combien de temps dure la formation ?</b></h2>
            <textarea name="temps_formation" class="form-control" id="temps_formation" maxlength="512" wrap cols="30" rows="10"><?php echo $formations->getTemps_formation(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Quels sont les pré-requis ?</b></h2>
            <textarea name="prerequis" class="form-control" id="prerequis" maxlength="512" wrap cols="30" rows="10"><?php echo $formations->getPrerequis(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>En quoi consiste l’examen ?</b></h2>
            <textarea name="examen" class="form-control" id="examen" maxlength="4096" wrap cols="30" rows="10"><?php echo $formations->getExamen(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Y a-t-il une remise à jour obligatoire ?</b></h2>
            <textarea name="remise_a_jour" class="form-control" id="remise_a_jour" maxlength="512" wrap cols="30" rows="10"><?php echo $formations->getRemise_a_jour(); ?></textarea>
            <br>
            <h2 class="text-danger"><b>Combien ça coûte ?</b></h2>
            <input type="number" class="form-control" name="tarif" class="form-control input" value="<?php echo $formations->getTarif(); ?>" id="tarif" placeholder="<?php echo $formations->getTarif(); ?>">
            <br>

            <p class="h3"><i><b> coût comprend :</b></i></p>
            <br>
            <textarea name="raison_tarif" class="form-control" id="raison_tarif" maxlength="512" wrap cols="30" rows="10"><?php echo $formations->getRaison_tarif(); ?></textarea>

            <br>


            <div class="form-group col-12">

                <input type="file" class="custom-file-input input" name="pdf" id="pdf">
                <label class="custom-file-label" for="pdf">Choisir un dossier d'inscription</label>

            </div>
            <input id="id_formation" name="id_formation" type="hidden" value="<?php echo $formations->getId(); ?>">
            <input id="old_pdf" name="old_pdf" type="hidden" value="<?php echo $formations->getFichier(); ?>">
            <div class="container">
                <button type="submit" value="button" id="submit" class="btn btn-primary btn-lg btn-block mt-3">Modifier</button>
            </div>

        </form>
    </div>
</section>







<?php
$content = ob_get_clean();
$titre = "Formation";
require "template.view.php";
?>