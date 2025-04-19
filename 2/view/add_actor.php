<?php
//add_actor.php
include("../config/database.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actorFullName = $_POST['ActorFullName'] ?? '';
    $actorYearOfBirth = $_POST['ActorYearOfBirth'] ?? '';
    $actorImageUrl = $_POST['ActorImageUrl'] ?? '';

    if ($actorFullName && $actorYearOfBirth && $actorImageUrl) {
        try {
            $stmt = $cnx->prepare("INSERT INTO actors (FullName, YearOfBirth, ImageUrl) VALUES (:name, :birth, :image)");
            $stmt->bindParam(':name', $actorFullName);
            $stmt->bindParam(':birth', $actorYearOfBirth, PDO::PARAM_INT);
            $stmt->bindParam(':image', $actorImageUrl);

            if ($stmt->execute()) {
                $newActorId = $cnx->lastInsertId();
                echo json_encode([
                    'success' => true,
                    'message' => 'Actor added successfully.',
                    'newActorId' => $newActorId,
                    'actorFullName' => $actorFullName
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add actor (execute failed).']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
header("Location: ad_films.php");
?>