<?php
class Message
{
    private $id_message;
    private $message;
    private $email;
    private $nom;
    private $prenom;
    private $numero;
    public static $messages;

    public function __construct($id_message, $message, $email, $nom, $prenom, $numero)
    {
        $this->id_message = $id_message;
        $this->message = $message;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero = $numero;
        self::$messages[] = $this;
    }

    public function getId()
    {
        return $this->id_message;
    }
    public function setId($id_message)
    {
        return $this->id_message = $id_message;
    }

    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message)
    {
        return $this->message = $message;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        return $this->prenom = $prenom;
    }

    public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        return $this->numero = $numero;
    }
}
