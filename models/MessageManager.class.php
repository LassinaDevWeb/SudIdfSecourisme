<?php
require_once "Model.class.php";
require_once "Message.class.php";


class MessageManager extends Model
{

    private $messages;

    public function ajoutAnnonce($message)
    {

        $this->messages[] = $message;
    }

    public function getMessage()
    {
        return $this->messages;
    }

    public function chargementMessage()
    {

        $sql = $this->getBdd()->prepare("SELECT id_message,message,email,nom,prenom,numero FROM  MESSAGE");
        $sql->execute();
        $mesMessages = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesMessages as $message) {
            $message = new Message($message['id_message'], $message['message'], $message['email'], $message['nom'], $message['prenom'], $message['numero']);
            $this->ajoutAnnonce($message);
        }
    }

    public function ajoutMessageBD($message, $email, $nom, $prenom, $numero)
    {

        $sql = '
        INSERT INTO MESSAGE (message,email,nom,prenom,numero)
        VALUES (:MESSAGE,:EMAIL,:NOM,:PRENOM,:NUMERO)
        ';
        //insert into ATELIERS_CATA(contenu,date_duree,prerequis,image,objectif,titre) values(?,?,?,?,?,?)
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":MESSAGE", $message, PDO::PARAM_STR);
        $stmt->bindValue(":EMAIL", $email, PDO::PARAM_STR);
        $stmt->bindValue(":NOM", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":PRENOM", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":NUMERO", $numero, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $message = new Message($this->getBdd()->lastInsertId(), $message, $email, $nom, $prenom, $numero);
            $this->ajoutAnnonce($message);
        }
    }



    public function getMessageById($id)
    {
        for ($i = 0; $i < count($this->messages); $i++) {
            if ($this->messages[$i]->getId() === $id) {
                return $this->messages[$i];
            }
        }
    }
    public function suppressionMessageBD($id)
    {
        $sql = '
        DELETE FROM MESSAGE WHERE id_message=:ID
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if ($resultat > 0) {
            $message = $this->getMessageById($id);
            unset($message);
        }
    }
}
