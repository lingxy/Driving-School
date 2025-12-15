<?php
$db = new SQLite3('students.db');

// Query all students
$result = $db->query("SELECT * FROM students ORDER BY id DESC");

echo "<table>";
echo "<tr><th>ID</th><th>Title</th><th>First Name</th><th>Surname</th><th>Phone</th><th>Licence</th><th>Period</th><th>Amount</th></tr>";

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['title']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['surname']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['licence']."</td>";
    echo "<td>".$row['period']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
