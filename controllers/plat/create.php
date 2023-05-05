<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../../config.php';
require_once '../../models/plat.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $plat = new Plat($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->nom_plat) && !empty($data->description) && !empty($data->type_plat) && !empty($data->PU_carte) ) {
        // On hydrate l'objet etudiant
        $plat->nom_plat = htmlspecialchars($data->nom_plat);
        $plat->description = htmlspecialchars($data->description);
        $plat->type_plat = htmlspecialchars($data->type_plat);
        $plat->PU_carte = htmlspecialchars($data->PU_carte);

        $result = $plat->create();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "Plat ajouté avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "L'ajout du plat a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>