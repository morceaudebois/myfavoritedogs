<?php require_once('includes/config.php');

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



// try {
//     $stmt = $db->prepare('SELECT * FROM dogtags');

//     $stmt->execute(array());
    
//     $tags = $stmt->fetchAll();

// } catch(PDOException $e) {
//     echo $e->getMessage();
// }

$data = $_GET['q'];
$races = explode("|", $data);

// va chercher les liens déjà existants
try {
    $stmt = $db->prepare('SELECT link FROM lists WHERE link = :link');

    do {
        $link = generateRandomString();
        $stmt->execute(array(
            'link' => $link
        ));
    
        $testLink = $stmt->fetch(PDO::FETCH_ASSOC);
        
    // tant que le lien est déjà pris
    } while (isset($testLink) && !empty($testLink));



} catch(PDOException $e) {
    echo $e->getMessage();
}




// check si la liste existe déjà
try {
    $stmt = $db->prepare('SELECT name, data, link FROM lists WHERE name = :name AND data = :data');
    
    $stmt->execute(array(
        ':name' => $races[1],
        ':data' => $races[0]
    ));

    $alreadyExists = $stmt->fetch(PDO::FETCH_ASSOC);
        
    if (isset($alreadyExists) && !empty($alreadyExists)) {

        // echo "This list already exists! Here's its permanent link.<br>";
        echo $homeURL . "list/index.php?q=" . $alreadyExists['link'];

    } else {
        // créée la nouvelle liste
        try {
            $stmt = $db->prepare('INSERT INTO lists (name, data, link) VALUES (:name, :data, :link)');

            $stmt->execute(array(
                ':name' => $races[1],
                ':data' => $races[0],
                ':link' => $link
            ));

            // echo "Your list has been saved! Here's your permanent link.<br>";
            echo $homeURL . "list/index.php?q=" . $link;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

} catch(PDOException $e) {
    echo $e->getMessage();
}




