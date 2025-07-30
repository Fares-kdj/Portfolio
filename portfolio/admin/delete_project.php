<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $project_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$project_id) {
        echo json_encode(['success' => false, 'message' => 'Invalid project ID']);
        exit;
    }

    try {
        // Begin transaction to ensure atomicity
        $conn->beginTransaction();

        // Fetch associated files to delete them from the file system
        $sql_files = "SELECT file_path FROM project_files WHERE project_id = ?";
        $stmt_files = $conn->prepare($sql_files);
        $stmt_files->execute([$project_id]);
        $files = $stmt_files->fetchAll(PDO::FETCH_ASSOC);

        // Delete physical files
        foreach ($files as $file) {
            $file_path = $file['file_path'];
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    throw new Exception("Failed to delete file: $file_path");
                }
            }
        }

        // Delete project files from project_files table
        $sql_delete_files = "DELETE FROM project_files WHERE project_id = ?";
        $stmt_delete_files = $conn->prepare($sql_delete_files);
        $stmt_delete_files->execute([$project_id]);

        // Delete project from projects table
        $sql_delete_project = "DELETE FROM projects WHERE id = ?";
        $stmt_delete_project = $conn->prepare($sql_delete_project);
        $stmt_delete_project->execute([$project_id]);

        // Commit transaction
        $conn->commit();

        echo json_encode(['success' => true, 'message' => 'Project deleted successfully']);
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollBack();
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method or missing ID']);
}
?>
