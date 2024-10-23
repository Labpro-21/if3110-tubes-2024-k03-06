<?php
$db = Database::getInstance();
$conn = $db->getConnection();
$stmt = $conn->prepare("SELECT * FROM _lowongan WHERE lowongan_id = :lowongan_id");
$stmt->bindParam(':lowongan_id', $_SESSION['lowongan_id']);
$stmt->execute();
$lowongan = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM _attachment_lowongan WHERE lowongan_id = :low_id");
$stmt->bindParam(':low_id', $_SESSION['lowongan_id']);
$stmt->execute();
$attachments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link rel="stylesheet" href="/public/views/action/update-job.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="/public/views/action/update-job.js"></script>
</head>

<body>
    <div class="navbar">
        <?php include __DIR__ . '/../navbar/navbarcomp.php'; ?>
    </div>

    <div class="update-job-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="home-picture">
                <img src="/public/assets/img/itb.jpeg">
            </div>
            <div class="profile-picture">
                <img src="/public/assets/img/photo.jpeg">
            </div>
            <div class="profile-info">
                <h4>Repsol Honda</h4>
                <p class="about">Motorcycle Company </p>
            </div>
        </div>

        <div class="update-job">
            <div class="container">
                <div class="back-button">
                    <i class='fas fa-arrow-circle-left' onclick="history.back()"></i>
                </div>
                <form id="update-job-form" action="/lowongan/editJob" method="POST" enctype="multipart/form-data">
                    <div class="update-job-form">
                        <h1>Update Your Current Job</h1>
                        <div class="update-job-container">
                            <div class="job-title">
                                <p>Job Title:</p>
                                <input class="input-box" type="text" id="job-title" value="<?php echo ($lowongan['posisi']); ?>" placeholder="job title" name="job-title" required>
                            </div>

                            <div class="job-description">
                                <p>Job Description:</p>
                                <div id="editor" id="job-description" style="height: 200px;"><?php echo ($lowongan['deskripsi']); ?></div>
                                <input type="hidden" id="job-description" name="job-description">
                            </div>

                            <div class="dragdown-container">
                                <div class="jobtype">
                                    <p class="update-job-section-title">Job Type:</p>
                                    <div class="update-job-section-left">
                                        <select id="job-type" name="job-type">
                                            <option value="full-time" <?php if ($lowongan['jenis_pekerjaan'] == 'full-time') echo 'selected'; ?>>Full-time</option>
                                            <option value="part-time" <?php if ($lowongan['jenis_pekerjaan'] == 'part-time') echo 'selected'; ?>>Part-time</option>
                                            <option value="contract" <?php if ($lowongan['jenis_pekerjaan'] == 'contract') echo 'selected'; ?>>Contract</option>option>
                                        </select>
                                    </div>
                                </div>

                                <div class="job-location">
                                    <p class="update-job-section-title">Job Location:</p>
                                    <div class="update-job-section-right">
                                        <select id="job-location" name="job-location">
                                            <option value="hybrid" <?php if ($lowongan['jenis_lokasi'] == 'hybrid') echo 'selected'; ?>>Hybrid</option>
                                            <option value="on-site" <?php if ($lowongan['jenis_lokasi'] == 'on-site') echo 'selected'; ?>>On-site</option>
                                            <option value="remote" <?php if ($lowongan['jenis_lokasi'] == 'remote') echo 'selected'; ?>>Remote</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="upload-image">
                                <p class="add-job-section-title">Add More Job Image:</p>
                                <label for="job-image" class="custom-file-upload">Choose File</label>
                                <input type="file" id="job-image" name="job-image[]" accept="image/*" style="display: none;" multiple>
                                <span id="file-chosen">No file chosen</span>
                                <br>
                                <br>

                                <p class="add-job-section-title">Job Attachment Now:</p>
                                <?php
                                if (count($attachments) != 0) {
                                    foreach ($attachments as $attachment) {
                                ?>
                                        <div class="image-item">
                                            <a href="<?php echo '../' . ($attachment['file_path']); ?>" target="_blank">View Image</a>
                                            <input type="checkbox" name="delete_images[]" value="<?php echo $attachment['attachment_id'] ?>"> Delete
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>

                            <div class="update-button">
                                <button type="submit" id="update-job-button">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>