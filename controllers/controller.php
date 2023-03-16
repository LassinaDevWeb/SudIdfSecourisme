<?php

require "models/FormationManager.class.php";
require "models/AdminManager.class.php";
require "models/CalendrierManager.class.php";
require "models/InstancierManager.class.php";
require "models/AnnonceManager.class.php";
require "models/MessageManager.class.php";

class sudidfsecourismeController
{

    public function __construct()
    {
        $this->formationManager = new FormationManager;
        $this->formationManager->chargementFormation();

        $this->adminManager = new AdminManager;
        $this->adminManager->chargementAdmin();

        $this->calendrierManager = new CalendrierManager;
        $this->calendrierManager->chargementCalendrier();

        $this->instancierManager = new InstancierManager;
        $this->instancierManager->chargementInstancier();

        $this->annonceManager = new AnnonceManager;
        $this->annonceManager->chargementAnnonce();

        $this->messageManager = new MessageManager;
        $this->messageManager->chargementMessage();
    }

    public function accueil()
    {
        unset($_SESSION['message_envoyer']);


        $list_formations = $this->formationManager->getFormation();
        $annonce = $this->annonceManager->getAnnonce();
        $information = $this->adminManager->getAdmin();
        require "views/accueil.view.php";
    }

    public function information()
    {
        unset($_SESSION['message_envoyer']);
        unset($_SESSION['image_oversize']);
        unset($_SESSION['no_admin']);
        $list_formations = $this->formationManager->getFormation();
        $annonce = $this->annonceManager->getAnnonce();
        $information = $this->adminManager->getAdmin();
        require "views/information.view.php";
    }


    public function modif_information()
    {
        $information =  isset($_POST['information']) ? $_POST['information'] : ' ';
        $id_info  = isset($_POST['id_admin']) ? $_POST['id_admin'] : ' ';

        if (
            !empty(!htmlentities(!htmlspecialchars($information)))
        ) {

            $this->adminManager->modificationInformationAdminBD($id_info, $information);
            header("Location:accueil");
        } else {
            header("Location:accueil");
        }
    }
    public function afficherList_formation()
    {
        unset($_SESSION['message_envoyer']);
        unset($_SESSION['image_oversize']);
        unset($_SESSION['no_admin']);
        $list_formations = $this->formationManager->getFormation();
        $formations = $this->formationManager->getFormation();
        if (empty($formations)) {

            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, la bdd est vide, veuillez ajouter un projet pour commencer."
            ];
            require "views/list_formation.view.php";
        } else {
            $formations = $this->formationManager->getFormation();
            $list_formations = $this->formationManager->getFormation();
            require "views/list_formation.view.php";
        }
    }

    public function formation($id)
    {
        $list_formations = $this->formationManager->getFormation();
        $formations = $this->formationManager->getFormationById($id);
        if (empty($formations)) {

            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, la bdd est vide, veuillez ajouter un projet pour commencer."
            ];
        } else {
            $formations = $this->formationManager->getFormationById($id);
            require "views/formation.view.php";
        }
    }

    public function create_formation()
    {
        if (!empty($_SESSION['prenom'])) {
            $list_formations = $this->formationManager->getFormation();
            require "views/create_formation.view.php";
        } else {
            header("Location:accueil");
        }
    }

    public function publi_formation()
    {


        $titre = isset($_POST['titre']) ? $_POST['titre'] : ' ';

        $tarif = isset($_POST['tarif']) ? $_POST['tarif'] : ' ';

        $description = isset($_POST['description']) ? $_POST['description'] : ' ';

        $raison_tarif =  isset($_POST['raison_tarif']) ? $_POST['raison_tarif'] : ' ';

        $changement = isset($_POST['changement']) ? $_POST['changement'] : ' ';

        $destinee = isset($_POST['destinee']) ? $_POST['destinee'] : ' ';

        $objectif = isset($_POST['objectif']) ? $_POST['objectif'] : ' ';

        $programme = isset($_POST['programme']) ? $_POST['programme'] : ' ';

        $prerequis =  isset($_POST['prerequis']) ? $_POST['prerequis'] : ' ';

        $examen = isset($_POST['examen']) ? $_POST['examen'] : ' ';

        $remise_a_jour = isset($_POST['remise_a_jour']) ? $_POST['remise_a_jour'] : ' ';

        $temps_formation =  isset($_POST['temps_formation']) ? $_POST['temps_formation'] : ' ';

        $nomficher = basename($_FILES["pdf"]["name"]);
        if (
            !empty(!htmlentities(!htmlspecialchars($titre)))
            && !empty(!htmlentities(!htmlspecialchars($tarif)))
            && !empty(!htmlentities(!htmlspecialchars($description)))
            && !empty(!htmlentities(!htmlspecialchars($raison_tarif)))
            && !empty(!htmlentities(!htmlspecialchars($changement)))
            && !empty(!htmlentities(!htmlspecialchars($destinee)))
            && !empty(!htmlentities(!htmlspecialchars($objectif)))
            && !empty(!htmlentities(!htmlspecialchars($programme)))
            && !empty(!htmlentities(!htmlspecialchars($prerequis)))
            && !empty(!htmlentities(!htmlspecialchars($examen)))
            && !empty(!htmlentities(!htmlspecialchars($remise_a_jour)))
            && !empty(!htmlentities(!htmlspecialchars($temps_formation)))
        ) {
            if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
                $error = 1;

                // verification de la taille de l'image
                if ($_FILES['pdf']['size'] <= 3000000) {
                    $infoImage = pathinfo($_FILES['pdf']['name']);
                    $extensionImage = $infoImage['extension'];
                    $extensionsArray = array('pdf', 'word', 'doc', 'docx');
                }

                $this->formationManager->ajoutFormationBD($destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $titre, $description, $prerequis, $examen, $nomficher);
                $formationbytitle = $this->formationManager->getFormationBytitle($titre);
                $id = $formationbytitle->getId();
                $fichier = $formationbytitle->getFichier();

                if (in_array($extensionImage, $extensionsArray)) {  // le type du fichier correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

                    $address = 'public/fichiers/' . $id . '-' . $fichier;
                    move_uploaded_file($_FILES['pdf']['tmp_name'], $address); // on renomme notre fichier avec une clé unique suivie du nom du fichier
                    header("Location:list_formation");
                    $error = 0;
                }
            }


            // $formations = $this->formationManager->getFormation();
        }
    }

    public function suppr_formation()
    {
        $id = $_POST['id_jumb_formation'];
        $formations = $this->formationManager->getFormationById($id);
        $instancier_formation = $this->instancierManager->getInstancierById($id);
        $nom_fichier =  $formations->getFichier();
        $fichier = $id . '-' . $nom_fichier;
        unlink('public/fichiers/' . $fichier);

        if (!empty($instancier_formation)) {


            $id_calend = $instancier_formation->getId_calend();

            $this->instancierManager->suppressionInstancierFormationBD($id);
            $this->calendrierManager->suppressionCalendrierBD($id_calend);
        }

        $this->formationManager->suppressionFormationBD($id);
        header("Location:list_formation");
    }
    public function modif_formation()
    {
        if (!empty($_SESSION['prenom'])) {
            $list_formations = $this->formationManager->getFormation();
            $id = $_POST['id_formation'];
            $formations = $this->formationManager->getFormationById($id);
            require "views/modif_formation.view.php";
        } else {
            header("Location:accueil");
        }
    }
    public function verif_modif_formation()
    {
        $id = isset($_POST['id_formation']) ? $_POST['id_formation'] : ' ';
        $old_pdf =  isset($_POST['old_pdf']) ? $_POST['old_pdf'] : ' ';
        $description =  isset($_POST['description']) ? $_POST['description'] : ' ';
        $titre = isset($_POST['titre']) ? $_POST['titre'] : ' ';
        $tarif = isset($_POST['tarif']) ? $_POST['tarif'] : ' ';
        $raison_tarif = isset($_POST['raison_tarif']) ? $_POST['raison_tarif'] : ' ';
        $changement = isset($_POST['changement']) ? $_POST['changement'] : ' ';
        $destinee = isset($_POST['destinee']) ? $_POST['destinee'] : ' ';
        $objectif = isset($_POST['objectif']) ? $_POST['objectif'] : ' ';
        $programme = isset($_POST['programme']) ? $_POST['programme'] : ' ';
        $prerequis = isset($_POST['prerequis']) ? $_POST['prerequis'] : ' ';
        $examen = isset($_POST['examen']) ? $_POST['examen'] : ' ';
        $remise_a_jour = isset($_POST['remise_a_jour']) ? $_POST['remise_a_jour'] : ' ';
        $temps_formation = isset($_POST['temps_formation']) ? $_POST['temps_formation'] : ' ';
        $nomficher = basename($_FILES["pdf"]["name"]);
        if (
            !empty(!htmlentities(!htmlspecialchars($titre)))
            && !empty(!htmlentities(!htmlspecialchars($tarif)))
            && !empty(!htmlentities(!htmlspecialchars($raison_tarif)))
            && !empty(!htmlentities(!htmlspecialchars($changement)))
            && !empty(!htmlentities(!htmlspecialchars($destinee)))
            && !empty(!htmlentities(!htmlspecialchars($objectif)))
            && !empty(!htmlentities(!htmlspecialchars($programme)))
            && !empty(!htmlentities(!htmlspecialchars($prerequis)))
            && !empty(!htmlentities(!htmlspecialchars($examen)))
            && !empty(!htmlentities(!htmlspecialchars($description)))
            && !empty(!htmlentities(!htmlspecialchars($remise_a_jour)))
            && !empty(!htmlentities(!htmlspecialchars($temps_formation)))
        ) {


            $this->formationManager->modificationFormationBD($id, $destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $description, $prerequis, $examen);
            if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
                $error = 1;

                // verification de la taille de l'image
                if ($_FILES['pdf']['size'] <= 3000000) {
                    $infoImage = pathinfo($_FILES['pdf']['name']);
                    $extensionImage = $infoImage['extension'];
                    $extensionsArray = array('pdf', 'word', 'doc', 'docx');
                    $old_fichier = $id . '-' . $old_pdf;
                    unlink('public/fichiers/' . $old_fichier);
                    $this->formationManager->modificationFichierformation($id, $nomficher);
                }

                if (in_array($extensionImage, $extensionsArray)) {  // le type du fichier correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

                    $address = 'public/fichiers/' . $id . '-' . $nomficher;
                    move_uploaded_file($_FILES['pdf']['tmp_name'], $address); // on renomme notre fichier avec une clé unique suivie du nom du fichier
                    $error = 0;
                }
            }
            header("Location:list_formation");
        }
    }

    public function connexion($identifiant, $password)
    {


        if (!isset($identifiant) || !isset($password)) {
            $_SESSION['alert'] = [
                "type" => "warning",
                "msg" => "Attention, tous les champs sont obligatoires pour pouvoir modifier le projet."
            ];
        } else {
            if (
                !empty(!htmlentities(!htmlspecialchars($identifiant)))
                && !empty(!htmlentities(!htmlspecialchars($password)))
            ) {
                $crypted = password_hash($password, PASSWORD_DEFAULT);

                $admin = $this->adminManager->getAdminByIdentifiantandpassword($identifiant, $password);
                if (!empty($admin)) {
                    unset($_SESSION['no_admin']);
                    $prenom = $this->adminManager->getNameByAdmin($identifiant);
                    $_SESSION['prenom'] = $prenom;
                    $list_formations = $this->formationManager->getFormation();
                    $annonce = $this->annonceManager->getAnnonce();
                    $information = $this->adminManager->getAdmin();
                    require "views/accueil.view.php";
                } else {
                    $_SESSION['no_admin'] = "Indentifiant ou Mot de passe Incorrect !";
                    header("Location:accueil");
                }
            }
        }
    }

    public function deconnexion()
    {

        unset($_SESSION['prenom']);
        $list_formations = $this->formationManager->getFormation();
        $annonce = $this->annonceManager->getAnnonce();
        $information = $this->adminManager->getAdmin();
        require "views/accueil.view.php";
    }

    public function calendrier()
    {
        unset($_SESSION['message_envoyer']);
        unset($_SESSION['image_oversize']);
        unset($_SESSION['no_admin']);
        $list_formations = $this->formationManager->getFormation();
        $instancier = $this->instancierManager->getInstancier();
        require "views/calendrier.view.php";
    }

    public function supprimer_date()
    {

        $id_formation = isset($_POST['id_formation']) ? $_POST['id_formation'] : ' ';
        $id_calendrier = isset($_POST['id_calendrier']) ? $_POST['id_calendrier'] : ' ';
        if (
            !empty(!htmlentities(!htmlspecialchars($id_formation)))
            && !empty(!htmlentities(!htmlspecialchars($id_calendrier)))
        ) {
            $this->instancierManager->suppressionInstancierBD($id_calendrier);
            $this->calendrierManager->suppressionCalendrierBD($id_calendrier);
            header("Location:calendrier");
        }
    }

    public function ajouter_date()
    {
        $id_forma = isset($_POST['id_formation']) ? $_POST['id_formation'] : ' ';
        $date = isset($_POST['date']) ? $_POST['date'] : ' ';
        if (
            !empty(!htmlentities(!htmlspecialchars($id_forma)))
            && !empty(!htmlentities(!htmlspecialchars($date)))
        ) {
            $this->calendrierManager->ajoutCalendrierBD($date);
            $id_calend = $this->calendrierManager->getIdbydate($date);
            $this->instancierManager->ajoutInstancierBD($id_forma, $id_calend);
            header("Location:calendrier");
        }
    }

    public function ajouter_annonce()
    {

        $nom = isset($_POST['nom']) ? $_POST['nom'] : ' ';
        $nomficher = basename($_FILES["image"]["name"]);


        if (
            !empty(!htmlentities(!htmlspecialchars($nom)))
        ) {
            //echo $nomficher;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $error = 1;

                // verification de la taille de l'image
                if ($_FILES['image']['size'] <= 3000000) {
                    $infoImage = pathinfo($_FILES['image']['name']);
                    $extensionImage = $infoImage['extension'];
                    $extensionsArray = array('png', 'gif', 'jpg', 'jpeg');
                } else {
                    $_SESSION['image_oversize'] = "Image trop volumineuse !";
                    header("Location:accueil");
                }

                $this->annonceManager->ajoutAnnonceBD($nom, $nomficher);
                $annoncebyname = $this->annonceManager->getAnnonceByName($nom);
                $id = $annoncebyname->getId();
                $img = $annoncebyname->getImage();
                unset($_SESSION['image_oversize']);

                if (in_array($extensionImage, $extensionsArray)) {  // le type de l'image correspond à ce que l'on attend, on peut alors l'envoyer sur notre serveur

                    $address = 'public/images/' . $id . '-' . $img;
                    move_uploaded_file($_FILES['image']['tmp_name'], $address); // on renomme notre image avec une clé unique suivie du nom du fichier

                    $error = 0;
                }
                header("Location:accueil");
            } else {
                $_SESSION['image_oversize'] = "Image trop volumineuse !";
                header("Location:accueil");
            }
        }
    }
    public function supprimer_annonce()
    {
        $annonce = $this->annonceManager->getAnnonceById($_POST['id_annonce']);
        $image = $annonce->getId() . '-' . $annonce->getImage();
        unlink('public/images/' . $image);
        $this->annonceManager->suppressionAnnonceBD($_POST['id_annonce']);
        header("Location:accueil");
    }
    public function contact()
    {
        $list_formations = $this->formationManager->getFormation();
        require "views/contact.view.php";
    }

    public function message()
    {

        $email = isset($_POST['email']) ? $_POST['email'] : ' ';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : ' ';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : ' ';
        $numero = isset($_POST['numero']) ? $_POST['numero'] : ' ';
        $message = isset($_POST['message']) ? $_POST['message'] : ' ';

        if (
            !empty(!htmlentities(!htmlspecialchars($email)))
            && !empty(!htmlentities(!htmlspecialchars($nom)))
            && !empty(!htmlentities(!htmlspecialchars($prenom)))
            && !empty(!htmlentities(!htmlspecialchars($numero)))
            && !empty(!htmlentities(!htmlspecialchars($message)))
        ) {
            $this->messageManager->ajoutMessageBD($message, $email, $nom, $prenom, $numero);
            $msg_envoyer = "Le message a bien etait envoyer ! ";
            $_SESSION['message_envoyer'] = $msg_envoyer;
            header("Location:contact");
        }
    }

    public function boite_message()
    {
        if (!empty($_SESSION['prenom'])) {
            $list_formations = $this->formationManager->getFormation();
            $message = $this->messageManager->getMessage();
            require "views/boite_message.view.php";
        } else {
            header("Location:accueil");
        }
    }

    public function suppr_message()
    {

        $id = $_POST['id_jumb_message'];
        $this->messageManager->suppressionMessageBD($id);

        header("Location:boite_message");
    }
}
