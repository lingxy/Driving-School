<?php
header('Content-Type: application/json; charset=UTF-8');

try {
    $db = new SQLite3(__DIR__ . '/students.db');

    // Adjust fields to match your table
    $query = "SELECT firstname, licence, period, amount FROM students ORDER BY id DESC";
    $result = $db->query($query);

    $students = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $students[] = $row;
    }

    echo json_encode($students);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error', 'details' => $e->getMessage()]);
}
