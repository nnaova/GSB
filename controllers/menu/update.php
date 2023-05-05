<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: PUT");

require_once '../../config.php';
require_once '../../models/menu.php';

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $menu = new menu($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id_menu) && !empty($data->nom_menu) && !empty($data->PU) && !empty($data->description) && !empty($data->date_menu)) {
        // On hydrate l'objet etudiant
        $menu->id_menu = intval($data->id_menu);
        $menu->nom_menu = htmlspecialchars($data->nom_menu);
        $menu->PU = intval($data->PU);
        $menu->description = htmlspecialchars($data->description);
        $menu->date_menu = date($data->date_menu);

        $result = $menu->update();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "Le menu a été modifié avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "La modification du menu a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>