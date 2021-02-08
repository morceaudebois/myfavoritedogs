<?php require_once('includes/config.php');

try {
    $stmt = $db->prepare('SELECT * FROM dogtags');

    $stmt->execute(array());
    
    $tags = $stmt->fetchAll();

} catch(PDOException $e) {
    echo $e->getMessage();
}



// foreach ($tags as $tag) {
//     echo $tag['Name'];
// }

$data = $_GET['q'];
$races = explode("|", $data);







$stmt = $db->prepare('INSERT INTO lists (name, data) VALUES (:name, :data)');

$stmt->execute(array(
    ':name' => $races[1],
    ':data' => $races[0]
));

echo "Your list has been saved.";