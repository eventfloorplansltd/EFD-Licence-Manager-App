<?php
include 'database_connection.php';
check_login();

if (empty($input['id'])) {
    send_error('Company ID is required.');
}

$companyId = (int)$input['id'];

// The FOREIGN KEY constraints with ON DELETE CASCADE will handle this.
// When a company is deleted, all users in that company are deleted.
// When those users are deleted, their user_addons assignments are deleted.

$sql = "DELETE FROM companies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $companyId);

if ($stmt->execute()) {
    send_json(['success' => true, 'id' => $companyId]);
} else {
    send_error('Error removing company: ' . $conn->error, 500);
}

$stmt->close();
$conn->close();
?>