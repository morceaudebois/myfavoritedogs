<?php require_once('includes/config.php');

$slug = $_GET['q'];


try {
    $db = new PDO('sqlite:myfavoritedogs.db');

    $stmt1 = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id WHERE dogbreeds.slug = :slug');
    $stmt1->execute(array(':slug' => $slug));
    $breed = $stmt1->fetch();

    // Va chercher les URL des photos
    $stmt1 = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id WHERE dogbreeds.slug = :slug');
    $stmt1->execute(array( ':slug' => $slug ));
    $breed = $stmt1->fetch();

    $stmt2 = $db->prepare('SELECT * FROM dogbreeds WHERE dogbreeds.slug = :slug');
    $stmt2->execute(array(':slug' => $slug));
    $text = $stmt2->fetch();

    $fullData = array(
        'name' => $text['title'],
        'slug' => $text['slug'],
        'photo_url' => $breed['photo_url']
    );

    echo json_encode($fullData);

} catch(PDOException $e) {
    echo $e->getMessage();
}


