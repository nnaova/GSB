<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: DELETE");

require_once '../../config.php';
require_once '../../models/menu.php';

if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $menu = new menu($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id_menu)) {
        $menu->id_menu = $data->id_menu;
        if ($menu->delete()) {
            http_response_code(200);
            echo json_encode(array("message" => "La suppression a été éffectué avec sucèss"));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "La suppression n'a été éffectué"));
        }
    } else {
        echo json_encode(['message' => "Vous devez precisé l'identifiant du menu"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>