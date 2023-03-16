<?php
class Calendrier
{
    private $id_calendrier;
    private $formation_date;



    public static $calendriers;

    public function __construct($id_calendrier, $formation_date)
    {
        $this->id_calendrier = $id_calendrier;
        $this->formation_date = $formation_date;
        self::$calendriers[] = $this;
    }

    public function getId()
    {
        return $this->id_calendrier;
    }
    public function setId($id_calendrier)
    {
        return $this->id_calendrier = $id_calendrier;
    }

    public function getFormation_date()
    {
        return $this->formation_date;
    }
    public function setFormation_date($formation_date)
    {
        return $this->formation_date = $formation_date;
    }
}
