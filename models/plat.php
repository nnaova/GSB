<?php
class Plat
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables etudiants
    private $table = "plat";
    private $connexion = null;

    // Les propritées de l'objet etudiant
    public $id_plat;
    public $nom_plat;
    public $description;
    public $type_plat;
    public $PU_carte;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    // Lecture des étudiants

    public function readAll()
    {
        // On ecrit la requete
        $sql = "SELECT * FROM plat ORDER BY id_plat DESC ";

        // On éxecute la requête
        $req = $this->connexion->query($sql);

        // On retourne le resultat
        return $req;
    }
    public function create()
    {
        $sql = "INSERT INTO $this->table(nom_plat,description,type_plat,PU_carte) VALUES(:nom_plat,:description,:type_plat,:PU_carte)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":nom_plat" => $this->nom_plat,
            ":description" => $this->description,
            ":type_plat" => $this->type_plat,
            ":PU_carte" => $this->PU_carte
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET nom_plat=:nom_plat, description=:description, type_plat=:type_plat, PU_carte=:PU_carte WHERE id_plat=:id_plat";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id_plat" => $this->id_plat,
            ":nom_plat" => $this->nom_plat,
            ":description" => $this->description,
            ":type_plat" => $this->type_plat,
            ":PU_carte" => $this->PU_carte
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table WHERE id_plat = :id_plat";
        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array(":id_plat" => $this->id_plat));

        if ($re) {
            return true;
        } else {
            return false;
        }
    }
}
?>