<?php
session_start();
require_once "controllers/controller.php";
$sudidfsecourismeController = new sudidfsecourismeController;

if (empty($_GET['page'])) {
    $sudidfsecourismeController->accueil();
} else {
    switch ($_GET['page']) {
        case "accueil":
            $sudidfsecourismeController->accueil();
            break;
        case "list_formation":
            $sudidfsecourismeController->afficherList_formation();
            break;

        case "formation":
            $sudidfsecourismeController->formation($_POST["id_jumb_formation"]);
            break;
        case "create_formation":
            $sudidfsecourismeController->create_formation();
            break;
        case "publi_formation":
            $sudidfsecourismeController->publi_formation();
            break;
        case "suppr_formation":
            $sudidfsecourismeController->suppr_formation();
            break;
        case "modif_formation":
            $sudidfsecourismeController->modif_formation();
            break;
        case "verif_modif_formation":
            $sudidfsecourismeController->verif_modif_formation();
            break;

        case "connexion":
            $sudidfsecourismeController->connexion($_POST["identifiant"], $_POST["password"]);
            break;

        case "deconnexion":
            $sudidfsecourismeController->deconnexion();
            break;

        case "calendrier":
            $sudidfsecourismeController->calendrier();
            break;

        case "supprimer_date":
            $sudidfsecourismeController->supprimer_date();
            break;

        case "ajouter_date":
            $sudidfsecourismeController->ajouter_date();
            break;

        case "ajouter_annonce":
            $sudidfsecourismeController->ajouter_annonce();
            break;
        case "supprimer_annonce":
            $sudidfsecourismeController->supprimer_annonce();
            break;

        case "modif_information":
            $sudidfsecourismeController->modif_information();
            break;

        case "contact":
            $sudidfsecourismeController->contact();
            break;

        case "message":
            $sudidfsecourismeController->message();
            break;

        case "boite_message":
            $sudidfsecourismeController->boite_message();
            break;

        case "suppr_message":
            $sudidfsecourismeController->suppr_message();
            break;

        case "information":
            $sudidfsecourismeController->information();
            break;
    }
}
