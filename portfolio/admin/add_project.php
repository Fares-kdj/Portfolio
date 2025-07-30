<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['logged_in'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
    $files = $_FILES['files'];

    // Destination folder
    $target_dir = "../Uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/webm', 'video/mov'];
    $error_message = '';
    $uploaded_files = [];

    // Check if files are uploaded
    if (!empty($files['name'][0])) {
        $file_count = count($files['name']);
        $is_video = false;

        // Check if a video is uploaded
        foreach ($files['tmp_name'] as $index => $tmp_name) {
            if ($tmp_name) {
                $file_type = mime_content_type($tmp_name);
                if (in_array($file_type, ['video/mp4', 'video/webm', 'video/mov'])) {
                    $is_video = true;
                    break;
                }
            }
        }

        // Validation: 1 video or up to 10 images
        if ($is_video && $file_count > 1) {
            echo json_encode(['success' => false, 'message' => 'You can only upload one video']);
            exit;
        } elseif (!$is_video && $file_count > 10) {
            echo json_encode(['success' => false, 'message' => 'You can upload a maximum of 10 images']);
            exit;
        } else {
            // Process each file
            foreach ($files['name'] as $index => $name) {
                if ($files['tmp_name'][$index]) {
                    $file_type = mime_content_type($files['tmp_name'][$index]);
                    if (!in_array($file_type, $allowed_types)) {
                        echo json_encode(['success' => false, 'message' => "File type not allowed for $name. Only images and videos are accepted"]);
                        exit;
                    }

                    $target_file = $target_dir . uniqid() . '_' . basename($name);
                    if (move_uploaded_file($files['tmp_name'][$index], $target_file)) {
                        $uploaded_files[] = ['path' => $target_file, 'type' => $file_type];
                    } else {
                        echo json_encode(['success' => false, 'message' => "Error uploading $name"]);
                        exit;
                    }
                }
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No files uploaded']);
        exit;
    }

    // Insert data into the database
    if (empty($error_message) && !empty($uploaded_files)) {
        try {
            $sql = "INSERT INTO projects (title, description, category, image_urls) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $first_file = $uploaded_files[0]['path']; // Use first file as primary image for grid view
            $stmt->execute([$title, $description, $category, $first_file]);
            $project_id = $conn->lastInsertId();

            // Insert file paths into project_files table
            $sql_file = "INSERT INTO project_files (project_id, file_path, file_type) VALUES (?, ?, ?)";
            $stmt_file = $conn->prepare($sql_file);
            foreach ($uploaded_files as $file) {
                $stmt_file->execute([$project_id, $file['path'], $file['type']]);
            }

            echo json_encode([
                'success' => true,
                'message' => 'Project added successfully',
                'project_id' => $project_id,
                'image_urls' => $first_file
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => $error_message ?: 'No files uploaded']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>