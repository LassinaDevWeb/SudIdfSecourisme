<?php
require_once "Model.class.php";
require_once "Formation.class.php";

class FormationManager extends Model
{

    private $formations;

    public function ajoutFormation($formation)
    {
        $this->formations[] = $formation;
    }

    public function getFormation()
    {
        return $this->formations;
    }

    public function chargementFormation()
    {
        $sql = $this->getBdd()->prepare("SELECT id_formation,destinee,objectif,temps_formation,tarif,raison_tarif,changement,programme,remise_a_jour,titre,description,prerequis,examen,fichier FROM FORMATION");
        $sql->execute();
        $mesFormation = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesFormation as $formation) {
            $formation = new Formation($formation['id_formation'], $formation['destinee'], $formation['objectif'], $formation['temps_formation'], $formation['tarif'], $formation['raison_tarif'], $formation['changement'], $formation['programme'], $formation['remise_a_jour'], $formation['titre'], $formation['description'], $formation['prerequis'], $formation['examen'], $formation['fichier']);
            $this->ajoutFormation($formation);
        }
    }


    public function ajoutFormationBD($destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $titre, $description, $prerequis, $examen, $fichier)
    {

        $sql = '
        INSERT INTO FORMATION (destinee,objectif,temps_formation,tarif,raison_tarif,changement,programme,remise_a_jour,titre,description,prerequis,examen,fichier)
        VALUES (:DESTINEE,:OBJECTIF,:TEMPS_FORMATION,:TARIF,:RAISON_TARIF,:CHANGEMENT,:PROGRAMME,:REMISE_A_JOUR,:TITRE,:DESCRIPTION,:PREREQUIS,:EXAMEN,:FICHIER)
        ';

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":DESTINEE", $destinee, PDO::PARAM_STR);
        $stmt->bindValue(":OBJECTIF", $objectif, PDO::PARAM_STR);
        $stmt->bindValue(":TEMPS_FORMATION", $temps_formation, PDO::PARAM_STR);
        $stmt->bindValue(":TARIF", $tarif, PDO::PARAM_INT);
        $stmt->bindValue(":RAISON_TARIF", $raison_tarif, PDO::PARAM_STR);
        $stmt->bindValue(":CHANGEMENT", $changement, PDO::PARAM_STR);
        $stmt->bindValue(":PROGRAMME", $programme, PDO::PARAM_STR);
        $stmt->bindValue(":REMISE_A_JOUR", $remise_a_jour, PDO::PARAM_STR);
        $stmt->bindValue(":TITRE", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":DESCRIPTION", $description, PDO::PARAM_STR);
        $stmt->bindValue(":PREREQUIS", $prerequis, PDO::PARAM_STR);
        $stmt->bindValue(":EXAMEN", $examen, PDO::PARAM_STR);
        $stmt->bindValue(":FICHIER", $fichier, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $formation = new Formation($this->getBdd()->lastInsertId(), $destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $titre, $description, $prerequis, $examen, $fichier);
            $this->ajoutFormation($formation);
        }
    }

    public function getFormationById($id)
    {
        for ($i = 0; $i < count($this->formations); $i++) {
            if ($this->formations[$i]->getId() === $id) {
                return $this->formations[$i];
            }
        }
        throw new Exception("La formation n'existe pas");
    }

    public function suppressionFormationBD($id)
    {
        $sql = '
        DELETE FROM FORMATION WHERE id_formation=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $formation = $this->getFormationById($id);
            unset($formation);
        }
    }

    public function modificationFormationBD($id, $destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $description, $prerequis, $examen)
    {
        $sql = '
        UPDATE FORMATION
        SET DESTINEE=:DESTINEE,OBJECTIF=:OBJECTIF,TEMPS_FORMATION=:TEMPS_FORMATION,TARIF=:TARIF,RAISON_TARIF=:RAISON_TARIF,CHANGEMENT=:CHANGEMENT,PROGRAMME=:PROGRAMME,REMISE_A_JOUR=:REMISE_A_JOUR,DESCRIPTION=:DESCRIPTION,PREREQUIS=:PREREQUIS,EXAMEN=:EXAMEN
        WHERE ID_FORMATION=:ID_FORMATION
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_FORMATION", $id, PDO::PARAM_INT);
        $stmt->bindValue(":DESTINEE", $destinee, PDO::PARAM_STR);
        $stmt->bindValue(":OBJECTIF", $objectif, PDO::PARAM_STR);
        $stmt->bindValue(":TEMPS_FORMATION", $temps_formation, PDO::PARAM_STR);
        $stmt->bindValue(":TARIF", $tarif, PDO::PARAM_INT);
        $stmt->bindValue(":RAISON_TARIF", $raison_tarif, PDO::PARAM_STR);
        $stmt->bindValue(":CHANGEMENT", $changement, PDO::PARAM_STR);
        $stmt->bindValue(":PROGRAMME", $programme, PDO::PARAM_STR);
        $stmt->bindValue(":REMISE_A_JOUR", $remise_a_jour, PDO::PARAM_STR);
        $stmt->bindValue(":DESCRIPTION", $description, PDO::PARAM_STR);
        $stmt->bindValue(":PREREQUIS", $prerequis, PDO::PARAM_STR);
        $stmt->bindValue(":EXAMEN", $examen, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $this->getFormationById($id)->setDestinee($destinee);
            $this->getFormationById($id)->setObjectif($objectif);
            $this->getFormationById($id)->setTemps_formation($temps_formation);
            $this->getFormationById($id)->setTarif($tarif);
            $this->getFormationById($id)->setRaison_tarif($raison_tarif);
            $this->getFormationById($id)->setChangement($changement);
            $this->getFormationById($id)->setProgramme($programme);
            $this->getFormationById($id)->setRemise_a_jour($remise_a_jour);
            $this->getFormationById($id)->setDescription($description);
            $this->getFormationById($id)->setPrerequis($prerequis);
            $this->getFormationById($id)->setExamen($examen);
        }
    }

    public function modificationFichierformation($id, $fichier)
    {
        $sql = ' UPDATE FORMATION
        SET FICHIER=:FICHIER
        WHERE ID_FORMATION=:ID_FORMATION';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_FORMATION", $id, PDO::PARAM_INT);
        $stmt->bindValue(":FICHIER", $fichier, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $this->getFormationById($id)->setDestinee($fichier);
        }
    }

    public function getFormationBytitle($titre)
    {
        for ($i = 0; $i < count($this->formations); $i++) {
            if ($this->formations[$i]->getTitre() === $titre) {
                return $this->formations[$i];
            }
        }
    }
}
