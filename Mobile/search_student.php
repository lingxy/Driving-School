<?php
header('Content-Type: application/json; charset=UTF-8');

try {
    $db = new SQLite3(__DIR__ . '/students.db');

    $input = isset($_GET['q']) ? trim($_GET['q']) : '';
    if ($input === '') { echo json_encode([]); exit; }

    // Only select the fields you want
    $stmt = $db->prepare("SELECT firstname, licence, period
                          FROM students
                          WHERE firstname LIKE :q OR surname LIKE :q OR phone LIKE :q
                          ORDER BY id DESC");
    $stmt->bindValue(':q', "%$input%", SQLITE3_TEXT);
    $result = $stmt->execute();

    $students = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $students[] = $row;
    }

    echo json_encode($students);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
