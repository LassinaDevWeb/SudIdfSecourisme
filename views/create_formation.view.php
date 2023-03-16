<?php ob_start();
?>




<section class="col-12 ml-2">
    <h1 class="mx-5 mt-3 mb-5 text-primary"><b><i>Creation de formation :</i></b></h1>
    <form action="publi_formation" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="titre">Titre</label>
                <input type="text" name="titre" class="form-control input" id="titre" required>
            </div>
            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="tarif">le tarif de la formation :</label>
                <input type="number" class="form-control" name="tarif" class="form-control input" id="tarif" required>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="description">Description de la formation :</label>
                <textarea name="description" class="form-control" id="description" maxlength="1024" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="raison_tarif">La raison du tarif de formation :</label>
                <textarea name="raison_tarif" class="form-control" id="raison_tarif" maxlength="512" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="changement">éventuelle changement :</label>
                <textarea name="changement" class="form-control" id="changement" maxlength="1024" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="destinee">Destinée a qui ? </label>
                <textarea name="destinee" class="form-control" id="destinee" maxlength="512" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="objectif">Objectif de la formation :</label>
                <textarea name="objectif" class="form-control" id="objectif" maxlength="1024" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" class="text-danger font-weight-bold font-italic" for="programme">Le programme de la formation :</label>
                <textarea name="programme" class="form-control" id="programme" maxlength="4096" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="prerequis">Les pré-requis pour la formation : </label>
                <textarea name="prerequis" class="form-control" id="prerequis" maxlength="512" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="examen">Description de l'examen de la formation :</label>
                <textarea name="examen" class="form-control" id="examen" maxlength="4096" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="remise_a_jour">éventuelle remise à jour obligatoire :</label>
                <textarea name="remise_a_jour" class="form-control" id="remise_a_jour" maxlength="512" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-6">
                <label class="text-danger font-weight-bold font-italic" for="temps_formation">La durée de la formation :</label>
                <textarea name="temps_formation" class="form-control" id="temps_formation" maxlength="512" wrap cols="30" rows="10" required></textarea>
            </div>

            <div class="form-group col-12">

                <input type="file" class="custom-file-input input" name="pdf" id="pdf" required>
                <label class="custom-file-label" for="pdf">Choisir un dossier d'inscription</label>

                <div class="container">
                    <button type="submit" value="button" id="submit" class="btn btn-primary btn-lg btn-block mt-3">Création</button>
                </div>
            </div>

    </form>

</section>







<?php
$content = ob_get_clean();
$titre = "Creation de Formation";
require "template.view.php";
?>