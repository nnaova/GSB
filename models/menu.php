<?php
class menu
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables etudiants
    private $table = "menu";
    private $connexion = null;

    // Les propritées de l'objet etudiant
    public $id_menu;
    public $nom_menu;
    public $PU;
    public $description;
    public $date_menu;

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
        $sql = "SELECT * FROM menu ORDER BY id_menu DESC ";

        // On éxecute la requête
        $req = $this->connexion->query($sql);

        // On retourne le resultat
        return $req;
    }
    public function create()
    {
        $sql = "INSERT INTO $this->table(nom_menu,PU,description,date_menu) VALUES(:nom_menu,:PU,:description,:date_menu)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":nom_menu" => $this->nom_menu,
            ":PU" => $this->PU,
            ":description" => $this->description,
            ":date_menu" => $this->date_menu
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET nom_menu=:nom_menu, PU=:PU, description=:description, date_menu=:date_menu WHERE id_menu=:id_menu";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id_menu" => $this->id_menu,
            ":nom_menu" => $this->nom_menu,
            ":PU" => $this->PU,
            ":description" => $this->description,
            ":date_menu" => $this->date_menu
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table WHERE id_menu = :id_menu";
        $req = $this->connexion->prepare($sql);

        $re = $req->execute(array(":id_menu" => $this->id_menu));

        if ($re) {
            return true;
        } else {
            return false;
        }
    }
}
?>