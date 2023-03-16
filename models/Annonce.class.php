<?php
class Annonce
{
    private $id_annonce;
    private $nom;
    private $img_primary;
    public static $annonces;

    public function __construct($id_annonce, $nom, $img_primary)
    {
        $this->id_annonce = $id_annonce;
        $this->nom = $nom;
        $this->img_primary = $img_primary;
        self::$annonces[] = $this;
    }

    public function getId()
    {
        return $this->id_annonce;
    }
    public function setId($id_annonce)
    {
        return $this->id_annonce = $id_annonce;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }

    public function getImage()
    {
        return $this->img_primary;
    }
    public function setImage($img_primary)
    {
        return $this->img_primary = $img_primary;
    }
}
