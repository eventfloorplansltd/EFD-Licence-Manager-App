<?php
include 'database_connection.php';
check_login();

if (!isset($input['id']) || !isset($input['onHold'])) {
    send_error('Company ID and onHold status are required.');
}

$companyId = (int)$input['id'];
$onHold = (bool)$input['onHold']; // Cast to boolean

$sql = "UPDATE companies SET onHold = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
// "i" for boolean (0 or 1), "i" for integer id
$stmt->bind_param("ii", $onHold, $companyId);

if ($stmt->execute()) {
    send_json(['success' => true, 'id' => $companyId, 'onHold' => $onHold]);
} else {
    send_error('Error updating company status: ' . $conn->error, 500);
}

$stmt->close();
$conn->close();
?>