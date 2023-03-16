<?php
require_once "Model.class.php";
require_once "Calendrier.class.php";


class CalendrierManager extends Model
{

    private $calendriers;

    public function ajoutCalendrier($calendrier)
    {

        $this->calendriers[] = $calendrier;
    }

    public function getCalendrier()
    {
        return $this->calendriers;
    }

    public function chargementCalendrier()
    {

        $sql = $this->getBdd()->prepare("SELECT id_calendrier,formation_date FROM  CALENDRIER");
        $sql->execute();
        $mesCalendrier = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesCalendrier as $calendrier) {
            $calendrier = new Calendrier($calendrier['id_calendrier'], $calendrier['formation_date']);
            $this->ajoutCalendrier($calendrier);
        }
    }

    public function ajoutCalendrierBD($formation_date)
    {

        $sql = '
        INSERT INTO CALENDRIER (formation_date)
        VALUES (:FORMATION_DATE)
        ';

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":FORMATION_DATE", $formation_date, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $calendrier = new Calendrier($this->getBdd()->lastInsertId(), $formation_date);
            $this->ajoutCalendrier($calendrier);
        }
    }

    public function getCalendrierById($id)
    {
        for ($i = 0; $i < count($this->calendriers); $i++) {
            if ($this->calendriers[$i]->getId() === $id) {
                return $this->calendriers[$i];
            }
        }
        throw new Exception("La formation n'existe pas");
    }

    public function suppressionCalendrierBD($id)
    {
        $sql = '
        DELETE FROM CALENDRIER WHERE id_calendrier=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $calendrier = $this->getCalendrierById($id);
            unset($calendrier);
        }
    }

    public function getIdbydate($date)
    {

        for ($i = 0; $i < count($this->calendriers); $i++) {
            if ($this->calendriers[$i]->getFormation_date() === $date) {
                return $this->calendriers[$i]->getId();
            }
        }
    }
}
