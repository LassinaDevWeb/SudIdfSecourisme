<?php
class Formation
{
    private $id_formation;
    private $destinee;
    private $objectif;
    private $temps_formation;
    private $tarif;
    private $raison_tarif;
    private $changement;
    private $programme;
    private $remise_a_jour;
    private $titre;
    private $description;
    private $prerequis;
    private $examen;
    private $fichier;

    public static $formations;

    public function __construct($id_formation, $destinee, $objectif, $temps_formation, $tarif, $raison_tarif, $changement, $programme, $remise_a_jour, $titre, $description, $prerequis, $examen, $fichier)
    {
        $this->id_formation = $id_formation;
        $this->destinee = $destinee;
        $this->objectif = $objectif;
        $this->temps_formation = $temps_formation;
        $this->tarif = $tarif;
        $this->raison_tarif = $raison_tarif;
        $this->changement = $changement;
        $this->programme = $programme;
        $this->remise_a_jour = $remise_a_jour;
        $this->titre = $titre;
        $this->description = $description;
        $this->prerequis = $prerequis;
        $this->examen = $examen;
        $this->fichier = $fichier;
        self::$formations[] = $this;
    }

    public function getId()
    {
        return $this->id_formation;
    }
    public function setId($id_formation)
    {
        return $this->id_formation = $id_formation;
    }

    public function getDestinee()
    {
        return $this->destinee;
    }
    public function setDestinee($destinee)
    {
        return $this->destinee = $destinee;
    }

    public function getObjectif()
    {
        return $this->objectif;
    }
    public function setObjectif($objectif)
    {
        return $this->objectif = $objectif;
    }

    public function getTemps_formation()
    {
        return $this->temps_formation;
    }
    public function setTemps_formation($temps_formation)
    {
        return $this->temps_formation = $temps_formation;
    }

    public function getTarif()
    {
        return $this->tarif;
    }
    public function setTarif($tarif)
    {
        return $this->tarif = $tarif;
    }

    public function getRaison_tarif()
    {
        return $this->raison_tarif;
    }
    public function setRaison_tarif($raison_tarif)
    {
        return $this->raison_tarif = $raison_tarif;
    }

    public function getChangement()
    {
        return $this->changement;
    }
    public function setChangement($changement)
    {
        return $this->changement = $changement;
    }

    public function getProgramme()
    {
        return $this->programme;
    }
    public function setProgramme($programme)
    {
        return $this->programme = $programme;
    }

    public function getRemise_a_jour()
    {
        return $this->remise_a_jour;
    }
    public function setRemise_a_jour($remise_a_jour)
    {
        return $this->remise_a_jour = $remise_a_jour;
    }

    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        return $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        return $this->description = $description;
    }

    public function getPrerequis()
    {
        return $this->prerequis;
    }
    public function setPrerequis($prerequis)
    {
        return $this->prerequis = $prerequis;
    }

    public function getExamen()
    {
        return $this->examen;
    }
    public function setExamen($examen)
    {
        return $this->examen = $examen;
    }

    public function getFichier()
    {
        return $this->fichier;
    }
    public function setFichier($fichier)
    {
        return $this->fichier = $fichier;
    }
}
