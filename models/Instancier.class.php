<?php
class Instancier
{
    private $id_forma;
    private $id_calend;
    private $formation_date;



    public static $instanciers;

    public function __construct($id_forma, $id_calend, $formation_date)
    {
        $this->id_forma = $id_forma;
        $this->id_calend = $id_calend;
        $this->formation_date = $formation_date;
        self::$instanciers[] = $this;
    }

    public function getId_forma()
    {
        return $this->id_forma;
    }
    public function setId_forma($id_forma)
    {
        return $this->id_forma = $id_forma;
    }

    public function getId_calend()
    {
        return $this->id_calend;
    }
    public function setId_calend($id_calend)
    {
        return $this->id_calend = $id_calend;
    }

    public function getFormation_date()
    {
        return $this->formation_date;
    }
}
