<?php
class menu_contient_plat
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables etudiants
    private $table = "menu_contient_plat";
    private $connexion = null;

    // Les propritées de l'objet etudiant
    public $id_menu;
    public $id_plat;

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
        $sql = "SELECT * FROM $this->table ORDER BY id_menu DESC ";

        // On éxecute la requête
        $req = $this->connexion->query($sql);

        // On retourne le resultat
        return $req;
    }
    public function create()
    {
        $sql = "INSERT INTO $this->table(id_menu, id_plat) VALUES(:id_menu, :id_plat)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id_menu" => $this->id_menu,
            ":id_plat" => $this->id_plat
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function delete()
    {
        $sql = "DELETE FROM $this->table WHERE id_plat = :id_plat AND id_menu = :id_menu";
        $req = $this->connexion->prepare($sql);

        $re = $req->execute(
            array(
                ":id_plat" => $this->id_plat,
                ":id_menu" => $this->id_menu
            )
        );
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
}
?>