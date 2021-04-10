<?php require_once('includes/config.php');


$slug = $_GET['q'];


try {
    // Va chercher les URL des photos
    $stmt = $db->prepare('SELECT photo_url FROM photos INNER JOIN dogbreeds ON dogbreeds.id = photos.breed_id WHERE dogbreeds.slug = :slug');

    $stmt->execute(array( ':slug' => $slug ));
    
    $breed = $stmt->fetch();

    echo $breed['photo_url'];
    // var_dump($breed);

} catch(PDOException $e) {
    echo $e->getMessage();
}


