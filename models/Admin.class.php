<?php
class Admin
{
    private $id_admin;
    private $nom;
    private $email;
    private $identifiant;
    private $password;
    private $numero;
    private $prenom;
    private $information;
    public static $admins;

    public function __construct($id_admin, $nom, $email, $identifiant, $password, $numero, $prenom, $information)
    {
        $this->id_admin = $id_admin;
        $this->nom = $nom;
        $this->email = $email;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->numero = $numero;
        $this->prenom = $prenom;
        $this->information = $information;
        self::$admins[] = $this;
    }

    public function getId()
    {
        return $this->id_admin;
    }
    public function setId($id_admin)
    {
        return $this->id_admin = $id_admin;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getIdentifiant()
    {
        return $this->identifiant;
    }
    public function setIdentifiant($identifiant)
    {
        return $this->identifiant = $identifiant;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        return $this->numero = $numero;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        return $this->prenom = $prenom;
    }

    public function getInformation()
    {
        return $this->information;
    }
    public function setInformation($information)
    {
        return $this->information = $information;
    }
}
