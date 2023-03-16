<?php ob_start();
?>




<?php if (!empty($_SESSION['prenom'])) {
    // Affichage d'un menu si un utilisateur est connecté 
?>
    <div class="float-right">
        <form action="modif_formation" method="post">
            <input id="id_formation" name="id_formation" type="hidden" value="<?php echo $formations->getId(); ?>">
            <input type="submit" name="search" value="Modifier" class="btn btn-outline-primary btn-lg">
        </form>
    </div>
<?php }
?>
<section>
    <div class="formation">

        <h1 class="text-primary  "><i><b>Formation <?php echo $formations->getTitre(); ?> </b></i></h1>
        <hr class="mx-5">

        <p class="h3"><i><?php echo $formations->getDescription(); ?></i></p>
        <br>
        <h2 class="text-danger"><b><?php echo nl2br($formations->getTitre()) ?> : Qu’est-ce qui change ?</b></h2>
        <p class="h3"><i><?php echo nl2br($formations->getChangement()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>A qui est destinée cette formation ?</b></h2>
        <br>
        <p class="h3"><i><?php echo nl2br($formations->getDestinee()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Quel est l’objectif de cette formation ?</b></h2>
        <p class="h3"><i><?php echo nl2br($formations->getObjectif()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Quel est le programme ?</b></h2>
        <p class="h3 textare"><i><?php echo nl2br($formations->getProgramme()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Combien de temps dure la formation ?</b></h2>
        <p class="h3"><i><?php echo nl2br($formations->getTemps_formation()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Quels sont les pré-requis ?</b></h2>
        <p class="h3 "><i><?php echo nl2br($formations->getPrerequis()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>En quoi consiste l’examen ?</b></h2>
        <p class="h3"><i><?php echo nl2br($formations->getExamen()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Y a-t-il une remise à jour obligatoire ?</b></h2>
        <p class="h3 "><i><?php echo nl2br($formations->getRemise_a_jour()) ?></i></p>
        <br>
        <h2 class="text-danger"><b>Combien ça coûte ?</b></h2>
        <p class="h3 "><i><?php echo nl2br($formations->getTarif()) ?>€</i></p>
        <br>
        <p class="h3"><i><b> coût comprend :</b></i></p>
        <br>
        <p class="h3"><i><?php echo nl2br($formations->getRaison_tarif()) ?></i></p>



        <a href="public/fichiers/<?php echo $formations->getId(); ?>-<?php echo $formations->getFichier(); ?>" class="btn btn-outline-danger">Telecharger dossier inscription</a>

    </div>
</section>







<?php
$content = ob_get_clean();
$titre = "Formation";
require "template.view.php";
?>