<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../../config.php';
require_once '../../models/contacts.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $user = new User($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));
    if (!empty($data->login) && !empty($data->role) && !empty($data->mdp)) {
        // On hydrate l'objet etudiant
        $user->login = htmlspecialchars($data->nom);
        $user->role = htmlspecialchars($data->prenom);
        $user->mdp = htmlspecialchars($data->mail);

        $result = $contact->create();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "étudiant ajouté avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "L'ajout de l'étudiant a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
?>