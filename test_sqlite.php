<?php
$db = new SQLite3('myfavoritedogs.db');

// Example: Query data
$result = $db->query('SELECT * FROM lists');
while ($row = $result->fetchArray()) {
    echo "ID: " . $row['id'] . ", Name: " . $row['name'] . "<br>";
}

$db->close();
