<?php
include 'database_connection.php';
check_login();

if (empty($input['id']) || !isset($input['name'])) {
    send_error('Addon ID and name are required.');
}

$addonId = (int)$input['id'];
$name = $conn->real_escape_string($input['name']);

$sql = "UPDATE addons SET name = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $name, $addonId);

if ($stmt->execute()) {
    send_json(['success' => true, 'id' => $addonId, 'name' => $name]);
} else {
    send_error('Error updating addon: ' . $conn->error, 500);
}

$stmt->close();
$conn->close();
?>