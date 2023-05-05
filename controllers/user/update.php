<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: PUT");

require_once '../../config.php';
require_once '../../models/contacts.php';

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $user = new User($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id_user) && !empty($data->login) && !empty($data->role) && !empty($data->mdp)) {
        // On hydrate l'objet etudiant
        $user->id_user = intval($data->id_user);
        $user->login = htmlspecialchars($data->login);
        $user->role = htmlspecialchars($data->role);
        $user->mdp = htmlspecialchars($data->mdp);

        $result = $user->update();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "étudiant a été modifié avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "La modification de l'étudiant a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>