<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../includes/db.php';

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $files = $_FILES['files'];

    // Destination folder
    $target_dir = "../uploads/";
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
            $error_message = "You can only upload one video.";
        } elseif (!$is_video && $file_count > 10) {
            $error_message = "You can upload a maximum of 10 images.";
        } else {
            // Process each file
            foreach ($files['name'] as $index => $name) {
                if ($files['tmp_name'][$index]) {
                    $file_type = mime_content_type($files['tmp_name'][$index]);
                    if (!in_array($file_type, $allowed_types)) {
                        $error_message = "File type not allowed for $name. Only images and videos are accepted.";
                        break;
                    }

                    $target_file = $target_dir . basename($name);
                    if (move_uploaded_file($files['tmp_name'][$index], $target_file)) {
                        $uploaded_files[] = ['path' => $target_file, 'type' => $file_type];
                    } else {
                        $error_message = "Error uploading $name.";
                        break;
                    }
                }
            }

            // Insert data into the database
            if (empty($error_message) && !empty($uploaded_files)) {
                // Assuming your database has a table to store multiple files
                $sql = "INSERT INTO projects (title, description, category) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$title, $description, $category]);
                $project_id = $conn->lastInsertId();

                // Insert file paths into a related table (e.g., project_files)
                $sql_file = "INSERT INTO project_files (project_id, file_path, file_type) VALUES (?, ?, ?)";
                $stmt_file = $conn->prepare($sql_file);
                foreach ($uploaded_files as $file) {
                    $stmt_file->execute([$project_id, $file['path'], $file['type']]);
                }

                header('Location: dashboard.php');
                exit();
            }
        }
    } else {
        $error_message = "No files uploaded.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="./add.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Project</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data" class="add-project-form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="design">Design</option>
                    <option value="web_development">Web Development</option>
                    <option value="filmmaking">Filmmaking</option>
                    <option value="video_editing">Video Editing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="files">Files (up to 10 images or 1 video):</label>
                <input type="file" id="files" name="files[]" class="form-control" accept="image/*,video/*" multiple required>
            </div>
            <button class="smoothScroll btn btn-default btn-lg" type="submit">
                <span>ADD</span>
            </button>
        </form>
    </div>
</body>
</html>