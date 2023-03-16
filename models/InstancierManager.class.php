<?php
require_once "Model.class.php";
require_once "Instancier.class.php";


class InstancierManager extends Model
{

    private $instanciers;

    public function ajoutInstancier($instancier)
    {

        $this->instanciers[] = $instancier;
    }

    public function getInstancier()
    {
        return $this->instanciers;
    }

    public function chargementInstancier()
    {

        $sql = $this->getBdd()->prepare("SELECT id_forma,id_calend,formation_date FROM INSTANCIER INNER JOIN CALENDRIER ON INSTANCIER.id_calend = CALENDRIER.id_calendrier");
        $sql->execute();
        $mesInstancier = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesInstancier as $instancier) {
            $instancier = new Instancier($instancier['id_forma'], $instancier['id_calend'], $instancier['formation_date']);
            $this->ajoutInstancier($instancier);
        }
    }

    public function ajoutInstancierBD($id_forma, $id_calend)
    {

        $sql = '
        INSERT INTO INSTANCIER (id_forma,id_calend)
        VALUES (:ID_FORMA,:ID_CALEND)
        ';

        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_FORMA", $id_forma, PDO::PARAM_INT);
        $stmt->bindValue(":ID_CALEND", $id_calend, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function getInstancierById($id)
    {
        if (!empty($this->instanciers)) {
            for ($i = 0; $i < count($this->instanciers); $i++) {
                if ($this->instanciers[$i]->getId_forma() === $id) {
                    return $this->instanciers[$i];
                }
            }
        }
    }


    public function suppressionInstancierBD($id)
    {
        $sql = '
        DELETE FROM INSTANCIER WHERE id_calend=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $instancier = $this->getInstancierById($id);
            unset($instancier);
        }
    }

    public function suppressionInstancierFormationBD($id)
    {

        $sql = '
        DELETE FROM INSTANCIER WHERE id_forma=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $instancier = $this->getInstancierById($id);
            unset($instancier);
        }
    }
}
