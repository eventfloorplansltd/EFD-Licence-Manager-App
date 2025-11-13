<?php
// No database connection needed here, but we do need sessions
session_start();

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

header('Content-Type: application/json');

// --- Hardcoded Credentials ---
$ADMIN_USER = 'admin';
$ADMIN_PASS = 'takachi987'; // <-- IMPORTANT: CHANGE THIS PASSWORD!

if (empty($input['username']) || empty($input['password'])) {
    echo json_encode(['success' => false, 'error' => 'Username and password are required.']);
    exit();
}

// Check credentials
if ($input['username'] === $ADMIN_USER && $input['password'] === $ADMIN_PASS) {
    // Correct! Store session data
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $ADMIN_USER;
    
    echo json_encode(['success' => true]);
} else {
    // Invalid credentials
    echo json_encode(['success' => false, 'error' => 'Invalid username or password.']);
}
?>