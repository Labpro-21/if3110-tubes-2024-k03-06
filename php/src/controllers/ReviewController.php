<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status']) && isset($_POST['message'])) {
    $status = $_POST['status'];
    $message = $_POST['message'];
    $lamaran_id = $_SESSION['lamaran_id'];

    $sql = "UPDATE _lamaran 
            SET status = :status, status_reason = :reason, updated_at = NOW() 
            WHERE lamaran_id = :lamaran_id";    
            
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':reason', $message);
    $stmt->bindParam(':lamaran_id', $lamaran_id);

    if ($stmt->execute()) {
        header("Location: index.php?page=lamaran");
        exit();
    } else {
        header("Location: index.php?page=lamaran");
        exit();
    }
}
?>