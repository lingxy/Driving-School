<?php
// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Connect to SQLite (creates file if not exists)
$db = new SQLite3('students.db');

// Create table if not exists
$db->exec("CREATE TABLE IF NOT EXISTS students (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT,
    firstname TEXT,
    surname TEXT,
    phone TEXT,
    licence TEXT,
    period TEXT,
    amount REAL
)");

// Insert record
$stmt = $db->prepare("INSERT INTO students (title, firstname, surname, phone, licence, period, amount) 
                      VALUES (:title, :firstname, :surname, :phone, :licence, :period, :amount)");

$stmt->bindValue(':title', $data['title']);
$stmt->bindValue(':firstname', $data['firstname']);
$stmt->bindValue(':surname', $data['surname']);
$stmt->bindValue(':phone', $data['phone']);
$stmt->bindValue(':licence', $data['licence']);
$stmt->bindValue(':period', $data['period']);
$stmt->bindValue(':amount', $data['amount']);

$stmt->execute();

echo "? Student saved successfully!";
?>
