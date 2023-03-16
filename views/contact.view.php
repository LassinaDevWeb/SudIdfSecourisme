<?php ob_start(); ?>




<h1 class="text-center text-danger mt-4"><i><u>Contact</u></i></h1>
<br>
<div class="m-5 p-5 rounded" id="formulaire_contact">
    <form action="message" method="POST">
        <div class="form-row">
            <div class="form-group col-6">
                <label class="text_contact" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group col-6">
                <label class="text_contact" for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
            </div>

            <div class="form-group col-6">
                <label class="text_contact" for=" prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
            </div>

            <div class="form-group col-6">
                <label class="text_contact" for=" numero">Numero</label>
                <input type="tel" class="form-control" id="numero" name="numero" placeholder="Numero" required>
            </div>

            <div class="form-group col-12">
                <label class="text_contact" for=" message">Message</label>
                <textarea name="message" class="form-control" id="message" maxlength="1024" wrap cols="30" rows="10" required> </textarea>
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Envoyer ma demande</button>
    </form>

</div>
<?php if (!empty($_SESSION['message_envoyer'])) {
    // Affichage d'un menu si un utilisateur est connecté 
?>
    <p class="text-center text-success h1"><?php echo $_SESSION['message_envoyer'] ?></p>


<?php } ?>


<?php
$content = ob_get_clean();
$titre = "Contact";
require "template.view.php";
?>