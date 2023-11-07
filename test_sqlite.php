<?php

$slug = $_GET['q'];

$db = new SQLite3('myfavoritedogs.db');

$stmt1 = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id WHERE dogbreeds.slug = :slug');
$stmt1->bindValue(':slug', $slug, SQLITE3_TEXT);
$result = $stmt1->execute();

var_dump($result->fetchArray());

$db->close();
