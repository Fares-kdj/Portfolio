<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    if ($project_id && $title && $description && $category) {
        try {
            $sql = "UPDATE projects SET title = :title, description = :description, category = :category WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':category' => $category,
                ':id' => $project_id
            ]);
            echo json_encode(['success' => true, 'message' => 'تم تحديث المشروع بنجاح']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>