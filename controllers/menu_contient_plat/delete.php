<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: DELETE");

require_once '../../config.php';
require_once '../../models/menu_contient_plat.php';

if ($_SERVER['REQUEST_METHOD'] === "DELETE") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $mcp = new menu_contient_plat($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id_menu) && !empty($data->id_plat)) {
        $mcp->id_menu = $data->id_menu;
        $mcp->id_plat = $data->id_plat;
        if ($mcp->delete()) {
            http_response_code(200);
            echo json_encode(array("message" => "La suppression a été éffectué avec sucèss"));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "La suppression n'a été éffectué"));
        }
    } else {
        echo json_encode(['message' => "Vous devez precisé l'identifiant de l'étudiant"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>