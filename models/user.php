<?php
class User
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables user
    private $table = "user";
    private $connexion = null;

    // Les propritées de l'objet user
    public $id_user;
    public $login;
    public $role;
    public $mdp;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    // Lecture des users

    public function readAll()
    {
        // On ecrit la requete
        $sql = "SELECT * FROM $this->table ORDER BY id DESC ";

        // On éxecute la requête
        $req = $this->connexion->query($sql);

        // On retourne le resultat
        return $req;
    }
    public function create()
    {
        $sql = "INSERT INTO $this->table(login,role,mdp) VALUES(:login,:role,:mdp)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":login" => $this->login,
            ":role" => $this->role,
            ":mdp" => $this->mdp
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET login=:login, role=:role, mdp=:mdp WHERE id_user=:id_user";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id_user" => $this->id_user,
            ":login" => $this->login,
            ":role" => $this->role,
            ":mdp" => $this->mdp
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array(":id" => $this->id_user));

        if ($re) {
            return true;
        } else {
            return false;
        }
    }
}
?>