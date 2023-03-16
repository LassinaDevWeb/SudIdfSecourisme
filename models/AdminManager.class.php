<?php
require_once "Model.class.php";
require_once "Admin.class.php";


class AdminManager extends Model
{

    private $admins;

    public function ajoutAdmin($admin)
    {

        $this->admins[] = $admin;
    }

    public function getAdmin()
    {
        return $this->admins;
    }

    public function chargementAdmin()
    {

        $sql = $this->getBdd()->prepare("SELECT id_admin,nom,email,identifiant,password,numero,prenom,information FROM ADMIN");
        $sql->execute();
        $mesAdmins = $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->closeCursor();
        foreach ($mesAdmins as $admin) {
            $admin = new Admin($admin['id_admin'], $admin['nom'], $admin['email'], $admin['identifiant'], $admin['password'], $admin['numero'], $admin['prenom'], $admin['information']);
            $this->ajoutAdmin($admin);
        }
    }



    public function getAdminByIdentifiantandpassword($identifiant, $password)
    {
        for ($i = 0; $i < count($this->admins); $i++) {
            if ($this->admins[$i]->getIdentifiant() === $identifiant) {
                if (password_verify($password, $this->admins[$i]->getPassword())) {
                    return true;
                } else {
                    echo $password;
                    echo nl2br("\n");
                    echo  $this->admins[$i]->getPassword();
                    echo nl2br("\n");
                    echo password_hash($password, PASSWORD_DEFAULT);
                }
            }
        }
    }

    public function getNameByAdmin($identifiant)
    {
        for ($i = 0; $i < count($this->admins); $i++) {
            if ($this->admins[$i]->getIdentifiant() === $identifiant) {
                return $this->admins[$i]->getPrenom();
            }
        }
    }

    public function getAdminByIdentifiantandNumero($identifiant, $numero)
    {
        for ($i = 0; $i < count($this->admins); $i++) {
            if ($this->admins[$i]->getIdentifiant() === $identifiant && $this->admins[$i]->getNumero() === $numero) {

                return true;
            }
        }
    }

    public function getAdminById($id)
    {
        for ($i = 0; $i < count($this->admins); $i++) {
            if ($this->admins[$i]->getId() === $id) {
                return $this->admins[$i];
            }
        }
    }

    public function modificationInformationAdminBD($id, $information)
    {
        $sql = '
        UPDATE ADMIN
        SET INFORMATION=:INFORMATION
        WHERE ID_ADMIN=:ID_ADMIN    
        ';
        $stmt = $this->getBdd()->prepare($sql);
        $stmt->bindValue(":ID_ADMIN", $id, PDO::PARAM_INT);
        $stmt->bindValue(":INFORMATION", $information, PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
}
