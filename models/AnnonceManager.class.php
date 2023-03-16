<?php
require_once "Model.class.php";
require_once "Annonce.class.php";


class AnnonceManager extends Model
{

    private $annonces;

    public function ajoutAnnonce($annonce)
    {

        $this->annonces[] = $annonce;
    }

    public function getAnnonce()
    {
        return $this->annonces;
    }

    public function chargementAnnonce()
    {

        $sql = $this->getBdd()->prepare("SELECT id_annonce,nom,img_primary FROM  ANNONCE");
        $sql->execute();
        $mesAnnonces = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesAnnonces as $annonce) {
            $annonce = new Annonce($annonce['id_annonce'], $annonce['nom'], $annonce['img_primary']);
            $this->ajoutAnnonce($annonce);
        }
    }

    public function ajoutAnnonceBD($nom, $img_primary)
    {

        $sql = '
        INSERT INTO ANNONCE (nom,img_primary)
        VALUES (:NOM,:IMG_PRIMARY)
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":NOM", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":IMG_PRIMARY", $img_primary, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $atelier_cata = new Annonce($this->getBdd()->lastInsertId(), $nom, $img_primary);
            $this->ajoutAnnonce($atelier_cata);
        }
    }

    public function getAnnonceByName($nom)
    {
        for ($i = 0; $i < count($this->annonces); $i++) {
            if ($this->annonces[$i]->getNom() === $nom) {
                return $this->annonces[$i];
            }
        }
    }

    public function getAnnonceById($id)
    {
        for ($i = 0; $i < count($this->annonces); $i++) {
            if ($this->annonces[$i]->getId() === $id) {
                return $this->annonces[$i];
            }
        }
    }
    public function suppressionAnnonceBD($id)
    {
        $sql = '
        DELETE FROM ANNONCE WHERE id_annonce=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $annonce = $this->getAnnonceById($id);
            unset($annonce);
        }
    }
}
